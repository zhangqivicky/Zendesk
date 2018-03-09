<!DOCTYPE html>
<html lang="en">
<?php include "header.php"; ?>
<body>
<div class="container">
  <h2>Mobile Ticket Viewer</h2>
<?php 
include "Ticket.Class.php";
$ticketApi = new TicketApi();
$all_tickets = $ticketApi->getAllTickets();
if(isset($all_tickets["error"])){ 
	echo $all_tickets["error"];
}else{ 
$ticket_num = count($all_tickets);
if($ticket_num > 0){ ?>
  <p><?php echo $ticket_num; ?> total tickets, <?php echo $ticket_num; ?> on this page</p>
  <ul class="list-group">
 <?php foreach($all_tickets as $ticket){ ?>
 	<a href="ticket-detail.php?id=<?php echo $ticket["id"]; ?>">
    <li class="list-group-item">
    <span class="status <?php echo $ticket["status"]; ?>"><?php echo $ticket["status"][0]; ?></span>
    <span class="title"><?php echo $ticketApi->shorten_title($ticket["subject"], 200); ?></span>
    </li>
    </a>
 <?php } ?>
  </ul>
<?php }else{ ?>
  <p class="error">There are not any tickets in this account!</p>
  <?php }} ?>
</div>
</body>
</html>
