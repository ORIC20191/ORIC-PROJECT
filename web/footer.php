		<footer class="footer" id="contato">
			<div class="content has-text-centered"><?php echo FOOTER; ?></div>
		</footer>
		<script src="web/assets/js/bulma.js"></script>
		<script>
		  var div = document.createElement('div');
		  div.className = 'fb-customerchat';
		  div.setAttribute('page_id', '2239054012782053');
		  div.setAttribute('ref', 'b64:VGVzdGVz');
		  document.body.appendChild(div);
		  window.fbMessengerPlugins = window.fbMessengerPlugins || {
		    init: function () {
		      FB.init({
		        appId            : '1678638095724206',
		        autoLogAppEvents : true,
		        xfbml            : true,
		        version          : 'v3.0'
		      });
		    }, callable: []
		  };
		  window.fbAsyncInit = window.fbAsyncInit || function () {
		    window.fbMessengerPlugins.callable.forEach(function (item) { item(); });
		    window.fbMessengerPlugins.init();
		  };
		  setTimeout(function () {
		    (function (d, s, id) {
		      var js, fjs = d.getElementsByTagName(s)[0];
		      if (d.getElementById(id)) { return; }
		      js = d.createElement(s);
		      js.id = id;
		      js.src = "//connect.facebook.net/en_US/sdk/xfbml.customerchat.js";
		      fjs.parentNode.insertBefore(js, fjs);
		    }(document, 'script', 'facebook-jssdk'));
		  }, 0);
		</script>
	</body>
</html>