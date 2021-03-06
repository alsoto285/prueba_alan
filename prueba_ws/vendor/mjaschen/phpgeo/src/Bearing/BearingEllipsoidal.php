<?php

declare(strict_types=1);

namespace Location\Bearing;

use InvalidArgumentException;
use Location\Coordinate;
use Location\Exception\NotConvergingException;

/**
 * Calculation of bearing between two points using a
 * ellipsoidal model of the earth.
 *
 * This class is based on the awesome work Chris Veness
 * has done. For more information visit the following URL.
 *
 * @see http://www.movable-type.co.uk/scripts/latlong-vincenty.html
 *
 * @author Marcus Jaschen <mjaschen@gmail.com>
 */
class BearingEllipsoidal implements BearingInterface
{
    /**
     * This method calculates the initial bearing between the
     * two points.
     *
     * If the two points share the same location, the bearing
     * value will be 0.0.
     *
     * @param Coordinate $point1
     * @param Coordinate $point2
     *
     * @return float Bearing Angle
     */
    public function calculateBearing(Coordinate $point1, Coordinate $point2): float
    {
        if ($point1->hasSameLocation($point2)) {
            return 0.0;
        }

        return $this->inverseVincenty($point1, $point2)->getBearingInitial();
    }

    /**
     * Calculates the final bearing between the two points.
     *
     * @param Coordinate $point1
     * @param Coordinate $point2
     *
     * @return float
     */
    public function calculateFinalBearing(Coordinate $point1, Coordinate $point2): float
    {
        return $this->inverseVincenty($point1, $point2)->getBearingFinal();
    }

    /**
     * Calculates a destination point for the given point, bearing angle,
     * and distance.
     *
     * @param Coordinate $point
     * @param float $bearing the bearing angle between 0 and 360 degrees
     * @param float $distance the distance to the destination point in meters
     *
     * @return Coordinate
     */
    public function calculateDestination(Coordinate $point, float $bearing, float $distance): Coordinate
    {
        return $this->directVincenty($point, $bearing, $distance)->getDestination();
    }

    /**
     * Calculates the final bearing angle for a destination point.
     * The method expects a starting point point, the bearing angle,
     * and the distance to destination.
     *
     * @param Coordinate $point
     * @param float $bearing
     * @param float $distance
     *
     * @return float
     *
     * @throws NotConvergingException
     */
    public function calculateDestinationFinalBearing(Coordinate $point, float $bearing, float $distance): float
    {
        return $this->directVincenty($point, $bearing, $distance)->getBearingFinal();
    }

    /**
     * @param Coordinate $point
     * @param float $bearing
     * @param float $distance
     *
     * @return DirectVincentyBearing
     *
     * @throws NotConvergingException
     */
    private function directVincenty(Coordinate $point, float $bearing, float $distance): DirectVincentyBearing
    {
        $phi1 = deg2rad($point->getLat());
        $lambda1 = deg2rad($point->getLng());
        $alpha1 = deg2rad($bearing);

        $a = $point->getEllipsoid()->getA();
        $b = $point->getEllipsoid()->getB();
        $f = 1 / $point->getEllipsoid()->getF();

        $sinAlpha1 = sin($alpha1);
        $cosAlpha1 = cos($alpha1);

        $tanU1 = (1 - $f) * tan($phi1);
        $cosU1 = 1 / sqrt(1 + $tanU1 * $tanU1);
        $sinU1 = $tanU1 * $cosU1;
        $sigma1 = atan2($tanU1, $cosAlpha1);
        $sinAlpha = $cosU1 * $sinAlpha1;
        $cosSquAlpha = 1 - $sinAlpha * $sinAlpha;
        $uSq = $cosSquAlpha * ($a * $a - $b * $b) / ($b * $b);
        $A = 1 + $uSq / 16384 * (4096 + $uSq * (-768 + $uSq * (320 - 175 * $uSq)));
        $B = $uSq / 1024 * (256 + $uSq * (-128 + $uSq * (74 - 47 * $uSq)));

        $sigmaS = $distance / ($b * $A);
        $sigma = $sigmaS;
        $iterations = 0;

        do {
            $cos2SigmaM = cos(2 * $sigma1 + $sigma);
            $sinSigma = sin($sigma);
            $cosSigma = cos($sigma);
            $deltaSigma = $B * $sinSigma
                * ($cos2SigmaM + $B / 4
                    * ($cosSigma
                        * (-1 + 2 * $cos2SigmaM * $cos2SigmaM) - $B / 6
                        * $cos2SigmaM * (-3 + 4 * $sinSigma * $sinSigma)
                        * (-3 + 4 * $cos2SigmaM * $cos2SigmaM)
                    )
                );
            $sigmaS = $sigma;
            $sigma = $distance / ($b * $A) + $deltaSigma;
            $iterations++;
        } while (abs($sigma - $sigmaS) > 1e-12 && $iterations < 200);

        if ($iterations >= 200) {
            throw new NotConvergingException('Inverse Vincenty Formula did not converge');
        }

        $tmp = $sinU1 * $sinSigma - $cosU1 * $cosSigma * $cosAlpha1;
        $phi2 = atan2(
            $sinU1 * $cosSigma + $cosU1 * $sinSigma * $cosAlpha1,
            (1 - $f) * sqrt($sinAlpha * $sinAlpha + $tmp * $tmp)
        );
        $lambda = atan2($sinSigma * $sinAlpha1, $cosU1 * $cosSigma - $sinU1 * $sinSigma * $cosAlpha1);
        $C = $f / 16 * $cosSquAlpha * (4 + $f * (4 - 3 * $cosSquAlpha));
        $L = $lambda
            - (1 - $C) * $f * $sinAlpha
            * ($sigma + $C * $sinSigma * ($cos2SigmaM + $C * $cosSigma * (-1 + 2 * $cos2SigmaM ** 2)));
        $lambda2 = fmod($lambda1 + $L + 3 * M_PI, 2 * M_PI) - M_PI;

        $alpha2 = atan2($sinAlpha, -$tmp);
        $alpha2 = fmod($alpha2 + 2 * M_PI, 2 * M_PI);

        return new DirectVincentyBearing(
            new Coordinate(rad2deg($phi2), rad2deg($lambda2), $point->getEllipsoid()),
            rad2deg($alpha2)
        );
    }

    /**
     * @param Coordinate $point1
     * @param Coordinate $point2
     *
     * @return InverseVincentyBearing
     *
     * @throws NotConvergingException
     */
    private function inverseVincenty(Coordinate $point1, Coordinate $point2): InverseVincentyBearing
    {
        $??1 = deg2rad($point1->getLat());
        $??2 = deg2rad($point2->getLat());
        $??1 = deg2rad($point1->getLng());
        $??2 = deg2rad($point2->getLng());

        $a = $point1->getEllipsoid()->getA();
        $b = $point1->getEllipsoid()->getB();
        $f = 1 / $point1->getEllipsoid()->getF();

        $L = $??2 - $??1;

        $tanU1 = (1 - $f) * tan($??1);
        $cosU1 = 1 / sqrt(1 + $tanU1 * $tanU1);
        $sinU1 = $tanU1 * $cosU1;
        $tanU2 = (1 - $f) * tan($??2);
        $cosU2 = 1 / sqrt(1 + $tanU2 * $tanU2);
        $sinU2 = $tanU2 * $cosU2;

        $?? = $L;

        $iterations = 0;

        do {
            $sin?? = sin($??);
            $cos?? = cos($??);
            $sinSq?? = ($cosU2 * $sin??) * ($cosU2 * $sin??)
                + ($cosU1 * $sinU2 - $sinU1 * $cosU2 * $cos??) * ($cosU1 * $sinU2 - $sinU1 * $cosU2 * $cos??);
            $sin?? = sqrt($sinSq??);

            if ($sin?? == 0) {
                new InverseVincentyBearing(0, 0, 0);
            }

            $cos?? = $sinU1 * $sinU2 + $cosU1 * $cosU2 * $cos??;
            $?? = atan2($sin??, $cos??);
            $sin?? = $cosU1 * $cosU2 * $sin?? / $sin??;
            $cosSq?? = 1 - $sin?? * $sin??;

            $cos2??M = 0;
            if ($cosSq?? !== 0.0) {
                $cos2??M = $cos?? - 2 * $sinU1 * $sinU2 / $cosSq??;
            }

            $C = $f / 16 * $cosSq?? * (4 + $f * (4 - 3 * $cosSq??));
            $??p = $??;
            $?? = $L + (1 - $C) * $f * $sin??
                * ($?? + $C * $sin?? * ($cos2??M + $C * $cos?? * (-1 + 2 * $cos2??M * $cos2??M)));
            $iterations++;
        } while (abs($?? - $??p) > 1e-12 && $iterations < 200);

        if ($iterations >= 200) {
            throw new NotConvergingException('Inverse Vincenty Formula did not converge');
        }

        $uSq = $cosSq?? * ($a * $a - $b * $b) / ($b * $b);
        $A = 1 + $uSq / 16384 * (4096 + $uSq * (-768 + $uSq * (320 - 175 * $uSq)));
        $B = $uSq / 1024 * (256 + $uSq * (-128 + $uSq * (74 - 47 * $uSq)));
        $???? = $B * $sin??
            * ($cos2??M + $B / 4
                * ($cos?? * (-1 + 2 * $cos2??M * $cos2??M) - $B / 6
                    * $cos2??M * (-3 + 4 * $sin?? * $sin??)
                    * (-3 + 4 * $cos2??M * $cos2??M)
                )
            );

        $s = $b * $A * ($?? - $????);

        $??1 = atan2($cosU2 * $sin??, $cosU1 * $sinU2 - $sinU1 * $cosU2 * $cos??);
        $??2 = atan2($cosU1 * $sin??, -$sinU1 * $cosU2 + $cosU1 * $sinU2 * $cos??);

        $??1 = fmod($??1 + 2 * M_PI, 2 * M_PI);
        $??2 = fmod($??2 + 2 * M_PI, 2 * M_PI);

        $s = round($s, 3);

        return new InverseVincentyBearing($s, rad2deg($??1), rad2deg($??2));
    }
}
