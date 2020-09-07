<?php

if($status == 'waiting'){
    $status_badge ='badge-primary';
    $status = 'Menunggu Pembayaran';
}
if($status =='paid'){
    $status_badge ='badge-info';
    $status = 'Dibayar';
}
if($status == 'delivered'){
    $status_badge ='badge-success';
    $status = 'Dikirim';
}
if($status == 'cancel'){
    $status_badge ='badge-danger';
    $status ='Dibatalkan';
}
?>

<?php if($status) :?>
<span class="badge badge-fill <?=$status_badge ?>"><?= $status ?></span>
<?php endif ?>