+(function (e, n, t, r) {
    +(function (i, o, a, c, s, u) {
        function f(e, n, t) {
            return 10 * ((t + e / 4) << 0) + n + (e % 4);
        }
        function d(e, n) {
            return e.repeat(n);
        }
        function l(e, n) {
            return L.substr(e, n);
        }
        function p() {
            (U = 1), t(R), k();
        }
        function v() {
            (U = 0), k(), T();
        }
        function y(e) {
            if (P) return (P = 0), void b();
            if (K && e in { 89: 1, 78: 1 })
                switch (((K = 0), e)) {
                    case 89:
                        b();
                        break;
                    case 78:
                        (P = 1), k();
                }
            if (!K) {
                if (U) return void v();
                if ((e in { 27: 1, 80: 1 } && p(), e in { 37: 1, 38: 1, 39: 1 })) {
                    var n = m(H);
                    switch (e) {
                        case 37:
                            n.x = 0 === n.x ? 0 : n.x - 1;
                            break;
                        case 39:
                            var t = 10 - c[n.i];
                            n.x = n.x === t ? t : n.x + 1;
                            break;
                        case 38:
                            var i = a[H.i],
                                o = 0,
                                s = 0;
                            u[i] && ((o = u[i][0]), (s = u[i][1])), (n = m(H, { x: H.x + o, y: H.y + s, i: i })), (n.x = r.min(n.x, 10 - c[n.i])), (n.x = r.max(n.x, 0));
                    }
                    (H = g(n) || H), E(), k();
                }
                if (e in { 40: 1, 32: 1 }) {
                    switch (e) {
                        case 40:
                            h();
                            break;
                        case 32:
                            for (; h(); );
                    }
                    k(), T();
                }
            }
        }
        function m(e, n) {
            var t = (19 * r.random()) << 0;
            return Object.assign({ x: 4 + (s[t] ? s[t] : 0), y: 0, c: 0, i: t }, e, n);
        }
        function g(e) {
            if (
                !o[e.i].some(function (n, t) {
                    if (((t = f(t, e.x, e.y)), n && (t >= 200 || i[t]))) return 1;
                })
            )
                return e;
        }
        function E() {
            (w = i.slice()),
                o[H.i].map(function (e, n) {
                    (n = f(n, H.x, H.y)), void 0 !== w[n] && (w[n] = w[n] || e);
                });
        }
        function h() {
            var t = m(H, { y: H.y + 1, c: H.c + 1 });
            if (((H = g(t) || H), E(), H === t)) return 1;
            if (!H.c)
                return (
                    (K = 1),
                    (C = ((new Date() - C) / 1e3) << 0),
                    void n(function () {
                        D(O, I, x, C);
                    })
                );
            (O += 10 * I), (H = A), (A = m()), (i = w);
            for (var r = 200, o = 10, a = 0, c = 0; (r -= o); ) i.slice(r, r + o).every(e) && (i.splice(r, o), (c += o), a < 4 && a++, ++x % 10 === 0 && (I = I < 9 ? I + 1 : 1));
            for (; c--; ) i.unshift(0);
            (O += [0, 50, 150, 350, 1e3][a] * I), i.some(e) || (O += 2e3 * I), (w = i), E();
        }
        function k() {
            var e = "\n\r",
                n = d(" ", 28),
                t = n + "<!",
                r = "!>" + n,
                i = r + t,
                a = String.fromCharCode(9646),
                c = d(a, 2),
                s = d(" ", 80) + e;
            if (P)
                return (
                    (n = d(" ", 19)),
                    (L = [-58917640, -942919668, 858981133, -2096247688, -1023360221, 53509168, -858816512]
                        .map(function (e) {
                            return (d("0", 10) + (e >>> 0).toString(2)).substr(-32);
                        })
                        .join("")
                        .substr(0, 210)
                        .split("")
                        .map(function (e) {
                            return [" ", a][e];
                        })
                        .join("")
                        .match(/.{1,42}/g)
                        .join(n + e + n)),
                    void (L = d(s, 8) + n + L + n + e + d(s, 4) + d(" ", 33) + "PRESS ANY KEY" + d(" ", 34) + e + d(s, 7))
                );
            (L = w
                .map(function (e) {
                    return [" .", c][e];
                })
                .join("")
                .match(/.{20}/g)
                .join(i)),
                (L = t + L + i + d("=", 20) + r + n + "  " + d("\\/", 10) + "  " + n);
            var u = x.toString();
            (u = "ROWS HIT:" + d(" ", 15 - u.length) + u), (L = u + l(24));
            var f = O.toString()
                .reverse()
                .match(/.{1,3}/g)
                .join(" ")
                .reverse();
            (f = "SCORE:" + d(" ", 18 - f.length) + f),
                (L = l(0, 80) + f + l(104)),
                (L = l(0, 160) + "LEVEL:" + d(" ", 17) + I + l(184)),
                o[A.i].map(function (e, n) {
                    (n = 80 * ((10 + (2 * n) / 8) << 0) + 20 + ((2 * n) % 8)), e && (L = l(0, n) + c + l(n + 2));
                }),
                (L = l(0, 138) + "UP ARROW: ROTATE" + l(154)),
                (L = l(0, 216) + "DOWN ARROW: SOFT DROP" + l(237)),
                (L = l(0, 298) + "SPACEBAR: HARD DROP" + l(317)),
                (L = l(0, 380) + "ESC, P: PAUSE" + l(393)),
                U && (L = l(0, 757) + "PAUSED" + l(763)),
                K && ((L = l(0, 756) + "TRY AGAIN?" + l(766)), (L = l(0, 836) + "   Y/N    " + l(846))),
                (L = L.match(/.{1,80}/g).join(e)),
                (L = s + L + e + d(s, 2)),
                N(L);
        }
        function S(e) {
            (D = e.finish || j), (N = e.nextFrame || j)(L);
        }
        function T() {
            t(R),
                K ||
                    P ||
                    (R = n(function () {
                        h(), k(), T();
                    }, 100 * (10 - I)));
        }
        function b() {
            (A = m()), (H = A), (i = M), (I = 1), (O = 0), (x = 0), (C = new Date()), (K = 0), E(), k(), T();
        }
        var L,
            w,
            R,
            I,
            O,
            x,
            C,
            A = m(),
            H = A,
            M = i.slice(),
            j = function () {},
            N = j,
            D = j,
            K = 0,
            U = 0,
            P = 1;
        b(), (window.TETRIS = { on: S, pause: p, pressKey: y, start: b, upause: v });
    })(
        "0".repeat(200).split("").map(e),
        [785, 23, 547, 116, 51, 114, 305, 39, 562, 15, 4369, 99, 306, 54, 561, 802, 113, 275, 71].map(function (n) {
            return (n >>> 0).toString(2).split("").reverse().map(e);
        }),
        [1, 2, 3, 0, 4, 6, 7, 8, 5, 10, 9, 12, 11, 14, 13, 16, 17, 18, 15],
        [2, 3, 2, 3, 2, 3, 2, 3, 2, 4, 1, 3, 2, 3, 2, 2, 3, 2, 3],
        { 9: -1, 10: 1 },
        { 5: [0, 0], 6: [1, 0], 7: [-1, 1], 8: [0, 0], 9: [-2, 2], 10: [2, -1], 11: [-1, 1], 12: [1, 0], 13: [-1, 1], 14: [1, 0] }
    );
})(parseFloat, setTimeout, clearTimeout, Math),
    (String.prototype.reverse = function () {
        for (var e = "", n = this.length; n--; ) e += this.charAt(n);
        return e;
    }),
    +(function () {
        function e(e) {
            if (32 === e) return void n(i);
            var t = (Math.random() * s.length) << 0;
            n(s[t]);
        }
        function n(e, n) {
            if (e && !c) {
                var t = r.createBufferSource();
                return (t.buffer = e), t.connect(r.destination), n && (t.loop = !0), t.start(0), t;
            }
        }
        function t(e, n) {
            function t(e) {
                var t = new XMLHttpRequest();
                t.open("GET", u + e, !0),
                    (t.responseType = "arraybuffer"),
                    (t.onload = function () {
                        r.decodeAudioData(t.response, n, function (e) {
                            "Error with decoding audio data" + e.err;
                        });
                    }),
                    t.send();
            }
            (e.map && e.map(t)) || t(e);
        }
        var r,
            i,
            o,
            a,
            c,
            s = [],
            u = "/gamesfolder/tetris-master/public/";
        (r = new (window.AudioContext || window.webkitAudioContext)()),
            t(["key1.ogg", "key2.ogg", "key3.ogg", "key4.ogg"], function (e) {
                s.push(e);
            }),
            t("space.ogg", function (e) {
                i = e;
            }),
            t("ambience.ogg", function (e) {
                a = n((o = e), !0);
            }),
            t("beep.ogg", n),
            document.getElementById("mute-sound").addEventListener("click", function (e) {
                (c = !c), c ? a && a.stop(0) : (a = n(o, !0)), (e.target.innerHTML = c ? "UNMUTE SOUND" : "MUTE SOUND"), e.target.blur();
            }),
            (window.playAudioKey = e);
    })() +
        (function () {
            function e(e) {
                return e
                    .toString()
                    .split("")
                    .reverse()
                    .join("")
                    .match(/.{1,3}/g)
                    .join(" ")
                    .split("")
                    .reverse()
                    .join("");
            }
            function n(e, n, t) {
                var r = t - e.length - n.length;
                return e + d.repeat(r > 0 ? r : 0) + n;
            }
            function t(e) {
                return document.getElementById(e);
            }
            function r(e, n) {
                function t() {
                    (e.innerHTML = "|/-\\".charAt(i) + d.repeat(n)), (i = ++i > 3 ? 0 : i);
                }
                var r = e.innerHTML,
                    i = 0;
                n = (n || 0) > 0 ? n - 1 : 0;
                var o = setInterval(t, 50);
                return (
                    t(),
                    function () {
                        clearInterval(o), (e.innerHTML = r);
                    }
                );
            }
            function i(e, n, t) {
                function r(e) {
                    (e.which || e.keyCode) === t && n();
                }
                return (
                    e.addEventListener("keydown", r),
                    function () {
                        e.removeEventListener("keydown", r);
                    }
                );
            }
            function o(e, n) {
                return i(e, n, 13);
            }
            function a(e, n) {
                return i(e, n, 27);
            }
            function c(i, c, s) {
                function u() {
                    t("userboard-send").removeEventListener("click", d), t("userboard-close").removeEventListener("click", f), (t("userboard").style.display = "none"), y(), m();
                }
                function f() {
                    u(), s();
                }
                function d() {
                    var e = t("name-input").value.toLocaleUpperCase();
                    if (e && !(e.length > 10)) {
                        t("userboard-send").removeEventListener("click", d), y(), (i.name = e);
                        var n = new XMLHttpRequest();
                        n.open("POST", "https://tetris-tiurin.rhcloud.com/api/scores", !0),
                            n.setRequestHeader("Content-type", "application/x-www-form-urlencoded"),
                            (n.onreadystatechange = function () {
                                n.readyState == XMLHttpRequest.DONE && 200 == n.status && (o(), u(), c());
                            }),
                            n.send(
                                Object.keys(i)
                                    .map(function (e) {
                                        return e + "=" + i[e];
                                    })
                                    .join("&")
                            );
                        var o = r(t("userboard-send"));
                        try {
                            localStorage.setItem("tetrisName", e);
                        } catch (e) {}
                    }
                }
                (t("userboard").style.display = "block"), (t("your-score").innerHTML = n("YOUR SCORE:", e(i.score), 32));
                try {
                    var l = new Date().getTime(),
                        p = JSON.parse(localStorage.getItem("tetrisScore")) || [];
                    p.push({ t: l, s: i.score }), localStorage.setItem("tetrisScore", JSON.stringify(p));
                    var v = p.sort(function (e, n) {
                        return n.s - e.s;
                    })[0].s;
                    t("your-best-score").innerHTML = n("YOUR BEST SCORE:", e(v), 32);
                } catch (e) {}
                try {
                    t("name-input").value = localStorage.getItem("tetrisName");
                } catch (e) {}
                t("name-input").focus(), t("userboard-send").addEventListener("click", d), t("userboard-close").addEventListener("click", f);
                var y = o(t("name-input"), d),
                    m = a(document, f);
            }
            function s(i) {
                function o() {
                    (c.style.display = "none"), u.removeEventListener("click", o), f(), i();
                }
                var c = t("leaderboard");
                if ("block" !== c.style.display) {
                    c.style.display = "block";
                    var s = r(t("score-leaders"), 32),
                        u = t("leaderboard-close");
                    u.addEventListener("click", o), u.focus();
                    var f = a(document, o),
                        d = new XMLHttpRequest();
                    d.open("GET", "https://tetris-tiurin.rhcloud.com/api/scores", !0),
                        (d.onload = function (r) {
                            var i = JSON.parse(r.target.response);
                            "ok" === i.status &&
                                (s(),
                                (t("score-leaders").innerHTML = i.scores
                                    .map(function (t) {
                                        return n(t.name, e(t.score), 32);
                                    })
                                    .join("<br>")));
                        }),
                        d.send();
                }
            }
            function u(e) {
                if (e.target.dataset && e.target.dataset.key) {
                    var n = parseInt(e.target.dataset.key);
                    TETRIS.pressKey(n), playAudioKey(n), e.target.blur();
                }
            }
            function f() {
                function e() {
                    clearInterval(t), (t = 0);
                }
                function n(n) {
                    if (!(n.altKey || n.ctrlKey || n.metaKey || n.shiftKey || ((keyCode = n.which > 0 ? n.which : n.keyCode), t && keyCode === r))) {
                        r = keyCode;
                        var i = function () {
                            TETRIS.pressKey(keyCode);
                        };
                        i(), e(), playAudioKey(keyCode);
                        var o = { 37: 100, 39: 100, 40: 50 };
                        t = setInterval(i, o[keyCode] || 200);
                    }
                }
                var t, r;
                return (
                    TETRIS.upause(),
                    setTimeout(function () {
                        addEventListener("keyup", e), addEventListener("keydown", n), addEventListener("click", u);
                    }),
                    function () {
                        clearInterval(t), removeEventListener("keyup", e), removeEventListener("keydown", n), removeEventListener("click", u), TETRIS.pause();
                    }
                );
            }
            var d = "&nbsp;",
                l = f();
            TETRIS.on({
                finish: function (e, n, t, r) {
                    l(),
                        c(
                            { score: e, level: n, rowsHit: t, time: r },
                            function () {
                                s(function () {
                                    TETRIS.start(), (l = f());
                                });
                            },
                            function () {
                                TETRIS.start(), (l = f());
                            }
                        );
                },
                nextFrame: function (e) {
                    (e = e.replace(/[ <>]|\n\r/g, function (e) {
                        return { " ": "&nbsp;", "<": "&lsaquo;", ">": "&rsaquo;", "\n\r": "<br>" }[e];
                    })),
                        (t("game").innerHTML = e);
                },
            }),
                t("leaderboard-link").addEventListener("click", function () {
                    l(),
                        s(function () {
                            l = f();
                        });
                });
        })() +
        (function (e) {
            var n = e.createElement("link");
            (n.rel = "stylesheet"), (n.href = "/gamesfolder/tetris-master/public/styles.css"), e.body.appendChild(n);
        })(document);
