function quoteFill(name, text) {
    // appends to the input field
    var elem = document.getElementById("thread-reply");
    var old_val = elem.value;
    elem.value = old_val + "[bbquote][bbname] " + name + "[/bbname]" + text + "[/bbquote]";
    elem.scrollIntoView();
}
