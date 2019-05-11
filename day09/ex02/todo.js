window.onload = function () {
    function get_cookie() {
        if (document.cookie === null || document.cookie === "") {
            return "";
        }
        return document.cookie;
    }
    function rm_item() {
        if (confirm("Task is done? Delete from list?") === true) {
            this.parentNode.removeChild(this);
        }
    }
    document.cookie = "hui=huigg";
    console.log(document.cookie);
    // alert(document.cookie);
    // let cook = get_cookie();
    let anchors = document.getElementsByClassName('entry');
    for (let anch of anchors) {
        anch.onclick = rm_item;
    }

    let bt = document.getElementById("new_butt");
    let list = document.getElementById("ft_list");
    bt.onclick = function () {
        let nw = prompt("Add new task");
        if (nw !== null && nw !== "") {
            let node = document.createElement("div");
            node.setAttribute('class', 'entry');
            let text_node = document.createTextNode(nw);
            node.appendChild(text_node);
            node.onclick = rm_item;
            list.prepend(node);
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
        // let cook = "todos=" + JSON.stringify(todos) + exp + "; path=/";
        let cook = "todos=" + "ff" + exp + "; path=/";

        console.log(cook);
        document.cookie = "hui=huigg";
        console.log(document.cookie);
        confirm(document.cookie);
    }
    set_cookie();
};