!(function (e) {
  "use strict";
  var a = ".ajax-contact",
    s = "is-invalid",
    t = '[name="email"]',
    n = e(".form-messages");
  e(a).on("submit", function (r) {
    var o, l, m, i;
    r.preventDefault(),
      (l = e(a).serialize()),
      (o =
        ((i = !0),
        (function t(n) {
          n = n.split(",");
          for (var r = 0; r < n.length; r++)
            e((m = a + " " + n[r])).val()
              ? (e(m).removeClass(s), (i = !0))
              : (e(m).addClass(s), (i = !1));
        })(
          '[name="name"],[name="email"],[name="number"],[name="subject"],[name="message"]'
        ),
        e(t).val() &&
        e(t)
          .val()
          .match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)
          ? (e(t).removeClass(s), (i = !0))
          : (e(t).addClass(s), (i = !1)),
        i)) &&
        jQuery
          .ajax({ url: e(a).attr("action"), data: l, type: "POST" })
          .done(function (s) {
            n.removeClass("error"),
              n.addClass("success"),
              n.text(s),
              e(a + ' input:not([type="submit"]),' + a + " textarea").val("");
          })
          .fail(function (e) {
            n.removeClass("success"),
              n.addClass("error"),
              "" !== e.responseText
                ? n.html(e.responseText)
                : n.html(
                    "Oops! An error occured and your message could not be sent."
                  );
          });
  });
})(jQuery);
