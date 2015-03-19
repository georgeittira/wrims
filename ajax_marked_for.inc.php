<!----Comments Form -----AJAX using jquery ----->
<script type="text/javascript" src="/jquery/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	     $(".action").change(function() {
		var id=$(this).val();
		var dataString = 'id='+ id;
		$.ajax
		({
		 type: "POST",
		 url: "toAgency.php",
		 data: dataString,
		 cache: false,
		 success: function(html){
			$(".marked_to").html(html);
		 }
		});

	   });

               });
</script>
