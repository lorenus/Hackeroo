body {
    cursor: url("{{ asset('img/cursors/left_ptr.cur') }}"), auto;
}

a, button, .hand-cursor {
    cursor: url("{{ asset('img/cursors/pointer.cur') }}"), pointer;
}

p, h1, h2, h3, h4, h5, h6, span, input[type="text"], textarea, .text-cursor {
    cursor: url("{{ asset('img/cursors/xterm.cur') }}"), text;
}