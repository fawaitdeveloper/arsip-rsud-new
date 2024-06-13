function handlerImage() {
    console.log("image");
}

var quill = new Quill("#editor-container", {
    modules: {
        formula: true,
        syntax: true,
        toolbar: "#toolbar-container",
    },
    placeholder: "Compose an epic...",
    theme: "snow",
});

quill.on("text-change", function () {
    $("#description").val(quill.root.innerHTML);
});
