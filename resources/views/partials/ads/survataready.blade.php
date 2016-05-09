<script type="text/javascript">
    var startSurvata = function () {
        var teaser  = document.getElementById('teaser-content'),
            content = document.getElementById('srvata-content'),
            link    = document.getElementById('srvata-link'),
            // content_xs = document.getElementById('srvata-content-xs'),
            // link_xs    = document.getElementById('srvata-link-xs'),
            loader  = document.getElementById('srvata-loader'),
            show = function(elt) { elt.style.display = 'block'; },
            hide = function(elt) { elt.style.display = 'none'; },
            showTeaser = function() {
                hide(loader); hide(content); // hide(content_xs);
                show(teaser); show(link); // show(link_xs);
            },
            showFull = function() {
                hide(loader); hide(teaser); hide(link); // hide(link_xs);
                show(content); // show(content_xs);
            };
            showWait = function() {
                show(loader); hide(teaser); hide(link); // hide(link_xs);
                hide(content); // hide(content_xs);
            };
        
        showWait();

        Survata.ready(function() {
            var s = Survata.createSurveywall({
                brand: "FreeTechBooks",
                explainer: "Complete this short survey to download the book.",
                allowSkip: false
            });

            s.on("load", function(data) {
                if ("monetizable" === data.status) {
                    Survata.util.bind(link, 'click', s.startInterview);
                    // Survata.util.bind(link_xs, 'click', s.startInterview);
                    showTeaser();
                }
                else {
                    showFull();
                }
            });

		    s.on("interviewSkip", function() {
                Survata.util.unbind(link, 'click', s.startInterview);
                // Survata.util.unbind(link_xs, 'click', s.startInterview);
                showFull();
		        alert("You skipped the interview. I'll give you the download link anyway :)");
		    }); 

            s.on("interviewComplete", function() {
                Survata.util.unbind(link, 'click', s.startInterview);
                // Survata.util.unbind(link_xs, 'click', s.startInterview);
                showFull();
		        alert("Thank you for finishing the interview. The download link is now available.");
            });
        });

        // Survata.fail(showFull);
	    Survata.fail(function() {
			showFull();
	    });

    };
</script>
