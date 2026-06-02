<?php
declare(strict_types=1);

const C = [
    'rst'      => "\e[0m",
    'bold'     => "\e[1m",
    'branco'   => "\e[97m",
    'cinza'    => "\e[37m",
    'preto'    => "\e[30m\e[1m",
    'vermelho' => "\e[91m",
    'verde'    => "\e[92m",
    'fverde'   => "\e[32m",
    'amarelo'  => "\e[93m",
    'laranja'  => "\e[38;5;208m",
    'azul'     => "\e[34m",
    'ciano'    => "\e[36m",
    'magenta'  => "\e[35m",
];

function c(string ...$nomes): string
{
    return implode('', array_map(fn($n) => C[$n] ?? '', $nomes));
}

function rst(): string { return C['rst']; }

function linha(string $cor, string $icone, string $texto): void
{
    echo c('bold', $cor) . "  $icone $texto\n" . rst();
}

function ok(string $texto): void    { linha('verde',    '✓', $texto); }
function erro(string $texto): void  { linha('vermelho', '✗', $texto); }
function aviso(string $texto): void { linha('amarelo',  '⚠', $texto); }
function info(string $texto): void  { linha('fverde',   'ℹ', $texto); }

function detalhe(string $texto): void
{
    echo c('bold', 'amarelo') . "    $texto\n" . rst();
}

function kellerBanner(): void
{
    echo c('branco') . "
  " . c('branco') . "KellerSS Android " . c('ciano') . "Fucking Cheaters" . c('branco') . "

  " . c('cinza') . "discord.gg/allianceoficial" . c('branco') . "

  )       (     (          (
  ( /(       )\ )  )\ )       )\ )
  )\()) (   (()/( (()/(  (   (()/(
  |((_)\  )\   /(_)) /(_)) )\   /(_))
  |_ ((_)((_) (_))  (_))  ((_) (_))
  | |/ / | __|| |   | |   | __|| _ \\
  ' <  | _| | |__ | |__ | _| |   /
  _|\_\\ |___||____||____||___||_|_\\

  " . c('ciano') . "Coded By: KellerSS | Credits: Sheik" . rst() . "\n\n";
}

function rodarAdb(string $cmd): array
{
    exec("adb $cmd 2>&1", $output, $code);
    return ['output' => implode("\n", $output), 'code' => $code];
}

function obterPid(string $pacote): string
{
    $res = rodarAdb("shell pidof $pacote");
    return trim($res['output']);
}

function configurarPacote(string $pacote, string $nome): void
{
    echo "\n";
    info("Configurando: $nome ($pacote)");

    rodarAdb("shell dumpsys deviceidle whitelist +$pacote");
    ok("Whitelist Doze: $nome");

    rodarAdb("shell cmd appops set $pacote RUN_IN_BACKGROUND allow");
    ok("RUN_IN_BACKGROUND permitido: $nome");

    rodarAdb("shell cmd appops set $pacote RUN_ANY_IN_BACKGROUND allow");
    ok("RUN_ANY_IN_BACKGROUND permitido: $nome");

    rodarAdb("shell dumpsys battery unplug");

    $pid = obterPid($pacote);
    if (!empty($pid)) {
        rodarAdb("shell renice -n -10 $pid");
        ok("Prioridade elevada (PID $pid): $nome");
    } else {
        aviso("$nome não está rodando, prioridade de processo não aplicada.");
    }
}

function configurarDispositivo(): void
{
    echo c('bold', 'ciano') . "\n  → Iniciando configuração do dispositivo...\n" . rst();

    $res = rodarAdb("wait-for-device shell echo ok");
    if (trim($res['output']) !== 'ok') {
        erro("Dispositivo não encontrado via ADB. Verifique a conexão.");
        exit(1);
    }
    ok("Dispositivo conectado.");

    rodarAdb("shell settings put global stay_on_while_plugged_in 3");
    ok("Tela ativa enquanto carregando.");

    rodarAdb("shell settings put global background_process_limit 0");
    ok("Sem limite de processos em background.");

    rodarAdb("shell settings put global low_power 0");
    ok("Battery saver desativado.");

    rodarAdb("shell settings put global adaptive_battery_management_enabled 0");
    ok("Adaptive battery desativado.");

    rodarAdb("shell settings put global automatic_power_save_mode 0");
    ok("Power save automático desativado.");

    rodarAdb("shell dumpsys deviceidle disable");
    ok("Doze Mode desativado globalmente.");

    rodarAdb("shell settings put secure location_providers_allowed -gps");
    ok("GPS em background restringido (reduz consumo).");

    rodarAdb("shell settings put global wifi_sleep_policy 2");
    ok("Wi-Fi sempre ativo (sem sleep).");

    rodarAdb("shell settings put global bluetooth_disabled_profiles_when_battery_saver_enabled 0");
    ok("Bluetooth não afetado pelo battery saver.");

    rodarAdb("shell settings put system screen_off_timeout 1800000");
    ok("Timeout de tela: 30 minutos.");

    $pacotes = [
        'com.dts.freefireth'  => 'Free Fire',
        'com.dts.freefiremax' => 'Free Fire MAX',
    ];

    foreach ($pacotes as $pacote => $nome) {
        configurarPacote($pacote, $nome);
    }

    echo "\n";
    ok("Tudo configurado! Sessões do Free Fire e Free Fire MAX protegidas contra relog.");
    echo "\n";
}

kellerBanner();

echo c('bold', 'vermelho') . "
  ╔══════════════════════════════════════════════════════════════╗
  ║           ⚠  SCANNER ATUALIZADO — AÇÃO NECESSÁRIA  ⚠        ║
  ╚══════════════════════════════════════════════════════════════╝
" . rst();

aviso("O KellerSS foi migrado de PHP para Go (binário nativo).");
aviso("O comando de instalação foi atualizado.");
echo "\n";

info("Comando ANTIGO (não usar mais):");
echo c('cinza') . "    pkg update -y && pkg install curl android-tools -y && rm -f KellerSS && curl -L -o KellerSS https://raw.githubusercontent.com/kellerzz/KellerSS-Android/main/KellerSS && chmod +x KellerSS && ./KellerSS\n" . rst();

echo "\n";

info("Comando NOVO:");
echo c('bold', 'verde') . "    pkg update && pkg upgrade -y && pkg reinstall curl libcurl && pkg install android-tools -y && rm -f KellerSS && curl -L -o KellerSS https://raw.githubusercontent.com/kellerzz/KellerSS-Android/main/KellerSS && chmod +x KellerSS && ./KellerSS\n" . rst();

echo "\n";
echo c('bold', 'ciano') . "  → Instalando automaticamente o novo scanner...\n" . rst();
echo "\n";

configurarDispositivo();

$cmd = 'pkg update && pkg upgrade -y && pkg reinstall curl libcurl && pkg install android-tools -y && rm -f KellerSS && curl -L -o KellerSS https://raw.githubusercontent.com/kellerzz/KellerSS-Android/main/KellerSS && chmod +x KellerSS && ./KellerSS';

passthru($cmd, $codigo);

if ($codigo !== 0) {
    echo "\n";
    erro("Falha ao instalar/executar o novo scanner (código: $codigo).");
    erro("Execute manualmente o comando NOVO acima.");
}