addEventListener('load', function() {

  // CODE TO CHECK WHICH TEMPLATE IS SELECTED AND THEN HIDE THE META BIX FOR SHOWING THE ADD ATTACHMENT OPTION TO USER
  const timer = this.setInterval(() => {
    if(this.document.querySelector(".edit-post-post-template__dropdown button")) {
      if(this.document.querySelector(".edit-post-post-template__dropdown button").getAttribute("aria-label") === "Select template: Custom Attachment Template") {
        document.querySelector("#custom-attachment-id").closest(".edit-post-layout__metaboxes").style.display = "block";
      } else {
        document.querySelector("#custom-attachment-id").closest(".edit-post-layout__metaboxes").style.display = "none";
      }
      this.clearInterval(timer);
    }
  }, 100);

  // TO HANDLE THE ONCHANGE OF THE SELECT DROPDOWN 
  // IF THE VALUE IS post_template.php ONLY THEN TO SHOW THE OPTION FOR THE ATTACHMENT
  document.querySelector("body").addEventListener("click", function(event) {
    if (event.target.matches(".edit-post-post-template__dialog select")) {
      if(event.target.value === "post_template.php") {
        document.querySelector("#custom-attachment-id").closest(".edit-post-layout__metaboxes").style.display = "block";
      } else {
        document.querySelector("#custom-attachment-id").closest(".edit-post-layout__metaboxes").style.display = "none";
      }
    }
  });

});