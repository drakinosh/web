function quoteFill(name, text) {
    document.getElementById("thread-reply").value = "[bbquote][bbname] " + name + "[/bbname]" + text + "[/bbquote]";
    document.getElementById("thread-reply").scrollIntoView();
}
