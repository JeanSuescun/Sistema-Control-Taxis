function loadjs(src) {
		document.write('<script src="images/headers/%27+src+%27" type="text/javascript"><\/script>');
}

if (typeof(jaAddEvent) == 'undefined') {
	function jaAddEvent(obj, evType, fn){
	 if (obj.addEventListener){
		 obj.addEventListener(evType, fn, false);
		 return true;
	 } else if (obj.attachEvent){
		 var r = obj.attachEvent("on"+evType, fn);
		 return r;
	 } else {
		 return false;
	 }
	}
}


