	<script>
	    (function(w, d, t, v, cb) {
	        w[v] = w[v] || {}; w[v].qr = []; w[v].qf = [];
	        var got = 0, g = function() {
	            if (got) { return; } got = 1;
	            var s = d.createElement(t); s.async = 'async';
	            s.src = 'https://api.survata.net/v2/js/survata.js?cb='+cb;
	            var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
	            w[v].ft = setTimeout(function() {
	                for (var i = 0; i < w[v].qf.length; i++) { w[v].qf[i][0].call(w[v]); }
	                w[v].f = 1; w[v].qf = [];
	                w[v].fail = function(fn) { fn.call(w[v]); return w[v]; };
	            }, 5000);
	        };
	        w[v].ready = function() { g(); w[v].qr.push(arguments); return w[v]; };
	        w[v].fail = function() { g(); w[v].qf.push(arguments); return w[v]; };
	        w[v].publisher = 'a24416af-c471-4e58-ade1-057e57e19255';
	    }(window, document, 'script', 'Survata', ((new Date().getTime())/1e3).toFixed()));
	</script>
