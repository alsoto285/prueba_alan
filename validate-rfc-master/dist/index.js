! function (n, e) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define(e) : (n = "undefined" != typeof globalThis ? globalThis : n || self).validateRfc = e()
}(this, (function () {
    "use strict";
    var n = {
            0: 0,
            1: 1,
            2: 2,
            3: 3,
            4: 4,
            5: 5,
            6: 6,
            7: 7,
            8: 8,
            9: 9,
            A: 10,
            B: 11,
            C: 12,
            D: 13,
            E: 14,
            F: 15,
            G: 16,
            H: 17,
            I: 18,
            J: 19,
            K: 20,
            L: 21,
            M: 22,
            N: 23,
            "&": 24,
            O: 25,
            P: 26,
            Q: 27,
            R: 28,
            S: 29,
            T: 30,
            U: 31,
            V: 32,
            W: 33,
            X: 34,
            Y: 35,
            Z: 36,
            " ": 37,
            "Ñ": 38
        },
        e = function (e) {
            var t = (12 === e.length ? " ".concat(e) : e).slice(0, -1),
                r = (11e3 - t.split("").reverse().reduce((function (e, t, r) {
                    return e + (n[t] || 0) * (r + 2)
                }), 0)) % 11;
            return 11 === r ? "0" : 10 === r ? "A" : String(r)
        },
        t = ["BUEI", "BUEY", "CACA", "CACO", "CAGA", "CAGO", "CAKA", "CAKO", "COGE", "COJA", "COJE", "COJI", "COJO", "CULO", "FETO", "GUEY", "JOTO", "KACA", "KACO", "KAGA", "KAGO", "KOGE", "KOJO", "KAKA", "KULO", "MAME", "MAMO", "MEAR", "MEAS", "MEON", "MION", "MOCO", "MULA", "PEDA", "PEDO", "PENE", "PUTA", "PUTO", "QULO", "RATA", "RUIN"],
        r = ["DAA020218JY1", "EDG811007RB3", "LIM0011098G0", "LME060822IH5", "NFS0103297H5"],
        i = /^([A-ZÑ\x26]{3,4})([0-9]{6})([A-Z0-9]{3})$/,
        u = "INVALID_FORMAT",
        c = "INVALID_DATE",
        A = "INVALID_VERIFICATION_DIGIT",
        o = "FORBIDDEN_WORD",
        f = {
            12: "company",
            13: "person"
        },
        l = {
            XEXX010101000: "foreign",
            XAXX010101000: "generic"
        },
        O = function (n) {
            var e = n.slice(0, -3).slice(-6),
                t = e.slice(0, 2),
                r = e.slice(2, 4),
                i = e.slice(4, 6),
                u = new Date("20".concat(t, "-").concat(r, "-").concat(i));
            return !isNaN(u.getTime())
        },
        s = function (n) {
            var t = n.slice(-1);
            return e(n) === t
        },
        a = function (n) {
            var e = (n || "").slice(0, 4);
            return t.includes(e)
        },
        E = function (n) {
            return n in l
        },
        C = function (n) {
            return r.includes(n)
        },
        I = function (n) {
            return l[n] || f[n.length] || null
        };
    return function (n, e) {
        var t = function (n) {
                return String(n).trim().toUpperCase().replace(/[^0-9A-ZÑ\x26]/g, "")
            }(n),
            r = function (n) {
                var e = (arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {}).omitVerificationDigit;
                if (E(n) || C(n)) return [];
                var t = [],
                    r = i.test(n),
                    f = !r || O(n),
                    l = !r || s(n);
                return r || t.push(u), f || t.push(c), l || e || t.push(A), a(n) && t.push(o), t
            }(t, e);
        return 0 === r.length ? function (n) {
            return {
                isValid: !0,
                rfc: n,
                type: I(n)
            }
        }(t) : function (n) {
            return {
                isValid: !1,
                rfc: null,
                type: null,
                errors: n
            }
        }(r)
    }
}));
//# sourceMappingURL=index.js.map