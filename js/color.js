var window = (function (r) {
  "use strict";
  var e = window.document,
    l = window.Math,
    n = e.createElement("canvas").getContext("2d"),
    a = function (r, e, n) {
      (r /= 255), (e /= 255), (n /= 255);
      var t,
        o = l.max(r, e, n),
        a = l.min(r, e, n),
        u = o,
        i = o - a,
        c = 0 === o ? 0 : i / o;
      if (o === a) t = 0;
      else {
        switch (o) {
          case r:
            t = (e - n) / i + (e < n ? 6 : 0);
            break;
          case e:
            t = (n - r) / i + 2;
            break;
          case n:
            t = (r - e) / i + 4;
        }
        t /= 6;
      }
      return { hue: t, saturation: c, brightness: u };
    };
  function o(r) {
    return r <= 10 ? r / 3294 : l.pow(r / 269 + 0.0513, 2.4);
  }
  function t(r) {
    return v(r) < 0.5;
  }
  function u(r, e, n, t) {
    return (
      "rgba(" +
      l.round(r) +
      ", " +
      l.round(e) +
      ", " +
      l.round(n) +
      ", " +
      t +
      ")"
    );
  }
  function i(r, e) {
    void 0 === e && (e = 0);
    var n = (t = d(r)).red,
      r = t.green,
      t = t.blue;
    return u(n, r, t, e / 100);
  }
  function c(r, e) {
    var n = (o = d(r)).red,
      t = o.green,
      r = o.blue,
      o = o.alpha,
      t = (n = a(n, t, r)).hue,
      r = n.saturation,
      n = n.brightness,
      n = (function (r, e, n) {
        var t,
          o,
          a,
          u = l.floor(6 * r),
          i = n * (1 - e),
          c = n * (1 - (r = 6 * r - u) * e),
          s = n * (1 - (1 - r) * e);
        switch (u % 6) {
          case 0:
            (t = n), (o = s), (a = i);
            break;
          case 1:
            (t = c), (o = n), (a = i);
            break;
          case 2:
            (t = i), (o = n), (a = s);
            break;
          case 3:
            (t = i), (o = c), (a = n);
            break;
          case 4:
            (t = s), (o = i), (a = n);
            break;
          case 5:
            (t = n), (o = i), (a = c);
        }
        return { red: 255 * t, green: 255 * o, blue: 255 * a };
      })(t, r, (n += n * (e / 100)));
    return u(n.red, n.green, n.blue, o);
  }
  var s,
    g,
    f,
    b,
    d =
      ((s = {}),
      function (r) {
        if (s[r]) return s[r];
        (n.fillStyle = "#fff"),
          n.fillRect(0, 0, 1, 1),
          (n.fillStyle = r),
          n.fillRect(0, 0, 1, 1);
        var e = n.getImageData(0, 0, 1, 1).data,
          e = { red: e[0], green: e[1], blue: e[2], alpha: e[3] / 255 };
        return (s[r] = e);
      }),
    h =
      ((g = {}),
      function (r) {
        if (g[r]) return g[r];
        var e = d(r),
          e = a(e.red, e.green, e.blue);
        return (g[r] = e);
      }),
    v =
      ((f = {}),
      function (r) {
        if (f[r]) return f[r];
        var e = d(r),
          n = e.red,
          t = e.green,
          e = e.blue,
          n = o(n),
          e = o(e),
          t = o(t);
        return (f[r] = 0.2126 * n + 0.7152 * t + 0.0722 * e);
      }),
    w =
      ((b = {}),
      function (r) {
        if (b[r]) return b[r];
        var e = 0,
          n = 0,
          t = v(r);
        return (
          0.9 <= t
            ? ((n = -50), (e = -30))
            : 0.7 <= t && t < 0.9
            ? ((n = -55), (e = -30))
            : 0.6 <= t && t < 0.7
            ? ((n = -50), (e = -15))
            : 0.5 <= t && t < 0.6
            ? ((n = -45), (e = -10))
            : 0.4 <= t && t < 0.5
            ? ((n = -40), (e = -5))
            : 0.3 <= t && t < 0.4
            ? ((n = -35), (e = 0))
            : 0.2 <= t && t < 0.3
            ? ((n = -30), (e = 20))
            : 0.1 <= t && t < 0.2
            ? ((n = -20), (e = 60))
            : 0 <= t && t < 0.1 && ((n = 0), (e = 80)),
          (b[r] = { foregroundColor: c(r, n), backgroundColor: c(r, e) })
        );
      });
  function k(r) {
    var e = d(r),
      r = a(e.red, e.green, e.blue),
      e = 100 * r.saturation,
      r = 100 * r.brightness;
    return l.sqrt(l.pow(100 - e, 2) + l.pow(100 - r, 2));
  }
  e = {
    rgbToHsb: a,
    getColorProperties: d,
    getHSB: h,
    getRelativeLuminanceWithWhite: v,
    isDark: t,
    transparentify: i,
    brighten: c,
    getColorVariations: w,
    getColorDistance: k,
    getHighlightColor: function (r, e) {
      return 90 < k(r)
        ? e
        : ((e = 100 * h(r).saturation),
          (r = w(r)),
          e <= 50 ? r.backgroundColor : r.foregroundColor);
    },
    getHoverStateColor: function (r, e, n) {
      return 90 < k(r)
        ? i(n, 3)
        : ((r = 100 * h(r).brightness), i(e, 50 < r ? 6 : 3));
    },
    getActiveStateColor: function (r, e, n) {
      return 90 < k(r)
        ? i(n, 6)
        : ((r = 100 * h(r).brightness), i(e, 50 < r ? 9 : 6));
    },
  };
  return (window.colorLib = e), (r.isDark = t), r;
})({});
