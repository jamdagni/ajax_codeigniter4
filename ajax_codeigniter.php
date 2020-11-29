


<main class="ttr-wrapper" id="main-profile">

</main>
<div class="ttr-wrapper" id="show1" style="display:none">

</div>


-----------buttons to operate them-------------------------

<a href="#" class="ttr-material-button" id="vet_myaccount" onclick="vet_info()"></a>
<a href="#" class="ttr-material-button" id="vet_question" onclick="vet_questions()"></a>


	<script type="text/javascript">
		function vet_questions() {
			$.ajax({
				url:"<?php echo base_url(); ?>/VetDashboard",
				type:'post',
				success:function(result) {
					$('#main-profile').hide();
					$('#show1').show();
				}
			})
		}
		function vet_info() {
			$.ajax({
				url:"<?php echo base_url(); ?>/VetDashboard",
				type:'post',
				success:function(result) {
					$('#main-profile').show();
					$('#show1').hide();
				}
			})
		}
	</script>


/***********************************************************/
//For sweetalert2 and codeigniter 4;

1. Retrieving data from DB

<?php
	$db = db_connect();
	$query = $db->table('questions')->get();
	foreach ($query->getResult() as $row){?>

<tr>
	<!--<th scope="row">heading</th>-->
	<?php
		$id = $row->question_id;
	?>
	<td><?php echo $row->question_id; ?></td>
	<td><?php echo $row->question_text; ?></td>
	<td><?php echo $row->question_category;?></td>
	//onclick to trigger.
	<td><a href="javascript:void(0)" type="button" id="answer" class="btn btn-success" onclick="answer(<?php echo $id?>)">Answer</a></td>
	<?php //<?php echo base_url('VetDashboard').'/'.$id ?>
</tr>

<?php } ?>

2.Controller
<?php
class Answer_vet extends Controller
{

		public function index()
		{
				echo "working" .$_POST['id']. " ".$_POST['text'] ;
		}

}
 ?>

3. JS Script with SA2 and ajax

<script type="text/javascript">
	function answer(id) {
		//var test = id;
		(async () => {

		const { value: text } = await Swal.fire({
			input: 'textarea',
			inputLabel: 'Message',
			inputPlaceholder: 'Type your message here...',
			inputAttributes: {
				'aria-label': 'Type your message here'
			},
			showCancelButton: true
		})
		var de = text;
		if (text) {
			//Swal.fire(text);
			//alert(de);
			//alert(id);
			$.ajax({
				url:"<?php echo base_url()?>/Answer_vet",
				type:"POST",
				dataType:"JSON",
				data:{
					'id':id,
					'text':text,
				},
				success:function(result) {
					//alert(result);
				},
			});

		}

	})();

	}
</script>
