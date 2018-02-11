@if(Auth::user()->status == 2)
	<script type="text/javascript">
		window.location.href="/";
	</script>
@endif