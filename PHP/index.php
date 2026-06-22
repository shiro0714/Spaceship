<?php
session_start();
require_once 'Entities/Spaceship.php';
require_once 'Entities/weapons.php';
require_once 'Entities/armory.php';

// --- DATA SETUP ---
if (!isset($_SESSION['results'])) $_SESSION['results'] = ['player' => 0, 'enemy' => 0];
if (!isset($_SESSION['enemies'])) {
    $_SESSION['enemies'] = [
        ['name' => 'Raider', 'hp' => 80, 'atk' => 15],
        ['name' => 'Destroyer', 'hp' => 120, 'atk' => 25],
        ['name' => 'Mothership', 'hp' => 200, 'atk' => 40]
    ];
}

$weapons = [
    new weapons("Pulse Rifle", 50, 6, 50),
    new weapons("Laser Cannon", 40, 8, 60),
    new weapons("Plasma Blaster", 60, 4, 40),
];

$log = [];
$msg = "";

// --- LOGICA ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // 1. Reset
    if ($action === 'reset') {
        $_SESSION['results'] = ['player' => 0, 'enemy' => 0];
        $msg = "Scores zijn gereset.";
    } 
    // 2. Add Enemy
    elseif ($action === 'add_enemy') {
        $_SESSION['enemies'][] = [
            'name' => $_POST['new_name'] ?: 'Alien',
            'hp'   => intval($_POST['new_hp'] ?: 50),
            'atk'  => intval($_POST['new_atk'] ?: 10)
        ];
        $msg = "Nieuwe vijand toegevoegd aan de lijst.";
    } 
    // 3. Battle
    elseif ($action === 'battle') {
        $pShip = new Spaceship($_POST['p_name']?:'Hero', 30, intval($_POST['p_hp']), intval($_POST['p_atk']));
        $pWep  = $weapons[$_POST['p_wep']];
        
        $eData = $_SESSION['enemies'][$_POST['e_id']];
        $eShip = new Spaceship($eData['name'], 20, $eData['hp'], $eData['atk']);
        
        $log[] = "Start: <strong>{$pShip->getName()}</strong> vs <strong>{$eShip->getName()}</strong>";
        
        // Fight Loop
        while ($pShip->getHP() > 0 && $eShip->getHP() > 0) {
            // Player Attack
            $dmg = rand($pShip->getAttack(), $pShip->getAttack() + $pWep->getdamage());
            $eShip->__setHP($eShip->getHP() - $dmg);
            $log[] = "Jij raakt voor $dmg schade. (Vijand HP: " . max(0, $eShip->getHP()) . ")";

            if ($eShip->getHP() <= 0) {
                $log[] = "<strong style='color:green'>WINNAAR: " . strtoupper($pShip->getName()) . "</strong>";
                $_SESSION['results']['player']++;
                break;
            }

            // Enemy Attack
            $dmg = rand($eShip->getAttack(), $eShip->getAttack() + 10);
            $pShip->__setHP($pShip->getHP() - $dmg);
            $log[] = "Vijand raakt voor $dmg schade. (Jouw HP: " . max(0, $pShip->getHP()) . ")";

            if ($pShip->getHP() <= 0) {
                $log[] = "<strong style='color:red'>VERLIEZER: Je schip is vernietigd.</strong>";
                $_SESSION['results']['enemy']++;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spaceship Battles</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>🚀 Spaceship Battle Arena</h1>

    <?php if($msg): ?>
        <div class="card success"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <div class="row">
        
        <div class="col-main">
            <div class="card">
                <h3>Start Gevecht</h3>
                <form method="post">
                    <input type="hidden" name="action" value="battle">
                    
                    <div class="row">
                        <div class="input-group">
                            <label>Schip Naam</label>
                            <input type="text" name="p_name" value="My Ship">
                        </div>
                        <div class="input-short">
                            <label>HP</label>
                            <input type="number" name="p_hp" value="100">
                        </div>
                        <div class="input-short">
                            <label>ATK</label>
                            <input type="number" name="p_atk" value="20">
                        </div>
                    </div>

                    <label>Kies Wapen</label>
                    <select name="p_wep">
                        <?php foreach($weapons as $i => $w): ?>
                            <option value="<?= $i ?>"><?= $w->getName() ?> (Dmg: <?= $w->getdamage() ?>)</option>
                        <?php endforeach; ?>
                    </select>

                    <label>Kies Tegenstander</label>
                    <select name="e_id">
                        <?php foreach($_SESSION['enemies'] as $i => $e): ?>
                            <option value="<?= $i ?>"><?= $e['name'] ?> (HP: <?= $e['hp'] ?>, Atk: <?= $e['atk'] ?>)</option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit" class="btn-primary">VECHT!</button>
                </form>
            </div>
            
            <?php if(!empty($log)): ?>
                <div class="card">
                    <h3>Battle Log</h3>
                    <?php foreach($log as $line): ?>
                        <div class="log-entry"><?= $line ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-side">
            <div class="card">
                <h3>Scorebord</h3>
                <p>Gewonnen: <strong><?= $_SESSION['results']['player'] ?></strong></p>
                <p>Verloren: <strong><?= $_SESSION['results']['enemy'] ?></strong></p>
                <form method="post">
                    <input type="hidden" name="action" value="reset">
                    <button class="btn-reset">Reset Score</button>
                </form>
            </div>

            <div class="card">
                <h3>Maak Vijand</h3>
                <form method="post">
                    <input type="hidden" name="action" value="add_enemy">
                    <label>Naam</label>
                    <input type="text" name="new_name" placeholder="Naam vijand" required>
                    
                    <div class="row">
                        <div class="input-group">
                            <label>HP</label>
                            <input type="number" name="new_hp" value="50">
                        </div>
                        <div class="input-group">
                            <label>Atk</label>
                            <input type="number" name="new_atk" value="10">
                        </div>
                    </div>
                    <button type="submit" class="btn-primary">Toevoegen</button>
                </form>
            </div>
        </div>

    </div>

</body>
</html>