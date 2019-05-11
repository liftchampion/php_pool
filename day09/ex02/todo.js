window.onload = function () {
    function get_cookie() {
        if (document.cookie === null || document.cookie === "") {
            return [];
        }
        return JSON.parse(decodeURIComponent(document.cookie.replace(/(?:(?:^|.*;\s*)todos\s*\=\s*([^;]*).*$)|^.*$/, "$1")));
    }
    function rm_item() {
        if (confirm("Task is done? Delete from list?") === true) {
            this.parentNode.removeChild(this);
        }
    }
    function add_todo(td, lst) {
        let node = document.createElement("div");
        node.setAttribute('class', 'entry');
        let text_node = document.createTextNode(td);
        node.appendChild(text_node);
        node.onclick = rm_item;
        lst.prepend(node);
    }
    let list = document.getElementById("ft_list");
    // alert(decodeURIComponent(document.cookie.replace(/(?:(?:^|.*;\s*)todos\s*\=\s*([^;]*).*$)|^.*$/, "$1")));
    let cook_arr = get_cookie();
    cook_arr.reverse();
    for (let ck of cook_arr) {
        // console.log(ck);
        add_todo(ck, list);
    }


    let anchors = document.getElementsByClassName('entry');
    for (let anch of anchors) {
        anch.onclick = rm_item;
    }

    let bt = document.getElementById("new_butt");
    bt.onclick = function () {
        let nw = prompt("Add new task");
        if (nw !== null && nw !== "") {
            add_todo(nw, list);
        }
    };
};
window.onunload = function () {
    function set_cookie() {
        let todos = [];
        let anchors = document.getElementsByClassName('entry');
        for (let anch of anchors) {
            todos.push(anch.innerHTML);
        }
        let date = new Date();
        date.setTime(date.getTime() + (24*60*60*1000));
        let exp = "; expires=" + date.toUTCString();
        let cook = "todos=" + encodeURIComponent(JSON.stringify(todos)) + exp + "; path=/";
        // let cook = "todos=" + "ff" + exp + "; path=/";

        // console.log(cook);
        document.cookie = cook;
        // console.log(document.cookie);
    }
    set_cookie();
};