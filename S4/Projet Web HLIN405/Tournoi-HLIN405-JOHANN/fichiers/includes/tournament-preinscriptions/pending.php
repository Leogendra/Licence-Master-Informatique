<?php
$team = $team_datas['team'];
$date = $team_datas['date'];
?>
<div id="postulate-row-team-<?php echo $team->getId(); ?>" class="d-flex align-items-center my-2">
    <div class="px-1">
        <img class="rounded" width="30px" src="<?php echo $team->getProfilePicture(); ?>" alt="Photo de profil de l'équipe <?php echo $team->getName(); ?>">
    </div>
    <div class="px-1">
        L'équipe "<?php echo $team->getName(); ?>" a postulé le <?php echo $date->format('d/m/Y'); ?> à <?php echo $date->format('H:i'); ?>
    </div>
    <div class="ms-auto d-flex align-items-center">
        <div class="px-1" title="">
            <button type="button" class="btn btn-warning" onclick="ph_accept_team(<?php echo $team->getId(); ?>)">Accepter</button>
        </div>
        <div class="px-1" title="">
            <button type="button" class="btn btn-danger" onclick="ph_refuse_team(<?php echo $team->getId(); ?>)">Refuser</button>
        </div>
    </div>
</div>