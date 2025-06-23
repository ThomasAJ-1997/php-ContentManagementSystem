tinymce.init({
  selector: "#content",
  plugins: "lists link image code",
  toolbar:
    "undo redo | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image | code",
  menubar: false,
  height: 300,
  setup: function (editor) {
    editor.on("init", function () {
      editor.getDoc().body.style.fontSize = "16px";
    });
  },
});
