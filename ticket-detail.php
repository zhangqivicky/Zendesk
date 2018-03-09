<!DOCTYPE html>
<html lang="en">
<?php include "header.php"; ?>
<body>
<div class="container">
  <h2>Mobile Ticket Viewer</h2>
<!-- Start to show ticket details -->  
<?php 
if(isset($_GET["id"])){
$id = $_GET["id"];
include "Ticket.Class.php";
$ticketApi = new TicketApi();
$ticket = $ticketApi->getTicketDetail($id);
if(isset($ticket["error"])){ 
	echo $ticket["error"];
}else{ ?>
  <p class="requester">Requester: <?php echo $ticket["requester"]; ?></p>
  <h3 class="title"><?php echo $ticket["subject"]; ?></h3>
  <p class="desc"><?php echo $ticket["description"]; ?></p>

<?php }
}else{ ?>
<p class="error">Error: The ticket id is missing in the request!</p>
<?php } ?>
<!-- End of ticket details -->  
<a href="index.php" >
  <button type="button" class="btn btn-primary back-btn">Back to all tickets</button>
</a>
</div>
</body>
</html>
