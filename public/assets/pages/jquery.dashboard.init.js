$(function () {
    "use strict";
    Morris.Area({
        element: "extra-area-chart", data: [
            {
                y: "2018-02-01", a: 0
            }
            , {
                y: "2018-02-02", a: 150
            }
            , {
                y: "2018-02-03", a: 60
            }
            , {
                y: "2018-02-04", a: 180
            }
            , {
                y: "2018-02-05", a: 9000
            }
            , {
                y: "2018-02-06", a: 75
            }
            , {
                y: "2018-02-07", a: 30
            }
        ], lineColors: ["#009688"], xkey: "y", ykeys: ["a"], labels: ["a"], pointSize: 0, lineWidth: 0, resize: 0, fillOpacity: .8, behaveLikeLine: 0, gridLineColor: "#e0e0e0", hideHover: "auto"
    }
    ), $(function () {
        var t = $(".todo-list"), o = $(".todo-list-input");
        $(".add-new-todo-btn").on("click", function (e) {
            e.preventDefault();
            var a = $(this).prevAll(".todo-list-input").val();
            a && (t.append("<div class='todo-box'><i class='remove fa fa-trash-o'></i><div class='todo-task'><label class='ckbox'><input type='checkbox'/><span>" + a + "</span><i class='input-helper'></i></label></div></div>"), o.val(""))
        }
        ), t.on("change", ".ckbox", function () {
            $(this).attr("checked") ? $(this).removeAttr("checked") : $(this).attr("checked", "checked"), $(this).closest(".todo-box").toggleClass("completed")
        }
        ), t.on("click", ".remove", function () {
            $(this).parent().remove()
        }
        )
    }
    )
}

);