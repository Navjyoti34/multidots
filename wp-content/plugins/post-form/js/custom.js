$(document).ready(function () {
  $("#new_post").submit(function (e) {
    e.preventDefault();
    alert("sdsdsa");
    var title = $("#title").val();
    var content = $("#content").val();
    var post_image = $("#post_image").val();
    var post_tags = $("#post_tags").val();
    var cat = $("#cat").val();
    $.ajax({
      data: {
        action: "postdata",
        title: title,
        content: content,
        post_image: post_image,
        post_tags: post_tags,
        cat: cat,
      },
      type: "post",
      url: ajaxurl,
      success: function (data) {
        if (data) {
          jQuery("#result_post_data").html(data);
          $("#title").val("");
          $("#content").val("");
          $("#post_image").val("");
          $("#post_tags").val("");
          $("#cat").val("");
        } else {
          jQuery("#result_post_data").html("No Post found");
        }
      },
    });
  });
});
