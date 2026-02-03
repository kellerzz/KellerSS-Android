<?php

$branco = "\e[97m";
$preto = "\e[30m\e[1m";
$amarelo = "\e[93m";
$laranja = "\e[38;5;208m";
$azul   = "\e[34m";
$lazul  = "\e[36m";
$cln    = "\e[0m";
$verde  = "\e[92m";
$fverde = "\e[32m";
$vermelho    = "\e[91m";
$magenta = "\e[35m";
$azulbg = "\e[44m";
$lazulbg = "\e[106m";
$verdebg = "\e[42m";
$lverdebg = "\e[102m";
$amarelobg = "\e[43m";
$lamarelobg = "\e[103m";
$vermelhobg = "\e[101m";
$cinza = "\e[37m";
$ciano = "\e[36m";
$bold   = "\e[1m";
function keller_banner(){
  echo "\e[97m
    ╔══════════════════════════════════════════════════════════════╗
    ║                                                              ║
    ║            \e[97mKellerSS Android \e[36mFucking Cheaters\e[97m                ║
    ║                \e[90mdiscord.gg/allianceoficial\e[97m                    ║
    ║                                                              ║
    ╚══════════════════════════════════════════════════════════════╝

                            )       (     (          (     
                        ( /(       )\ )  )\ )       )\ )  
                        )\()) (   (()/( (()/(  (   (()/(  
                        |((_)\  )\   /(_)) /(_)) )\   /(_)) 
                        |_ ((_)((_) (_))  (_))  ((_) (_))   
                        | |/ / | __|| |   | |   | __|| _ \  
                        ' <  | _| | |__ | |__ | _| |   /  
                        _|\_\ |___||____||____||___||_|_\  

                \e[36mCoded By: KellerSS | Credits: Sheik\e[0m
  \n";
}


echo $cln;

function atualizar()
{
    global $cln, $bold, $fverde, $vermelho, $azul;
    echo "\n" . $bold . $azul . "┌─ KELLERSS UPDATER\n" . $cln;
    echo $vermelho . "  ⟳ Atualizando, aguarde...\n\n" . $cln;
    system("git fetch origin && git reset --hard origin/master && git clean -f -d");
    echo $bold . $fverde . "  ✓ Atualização concluída! Reinicie o scanner\n" . $cln;
    exit;
}

function detectarBypassShell() {
    global $bold, $vermelho, $amarelo, $fverde, $azul, $branco, $cln, $verde, $ciano;
    
    $bypassDetectado = false;
    $totalVerificacoes = 0;
    $problemasEncontrados = 0;
    
    echo "\n";
    echo $bold . $ciano . "╔═══════════════════════════════════════════════════════════════════╗\n";
    echo $bold . $ciano . "║          ANÁLISE COMPLETA DE SEGURANÇA DO DISPOSITIVO             ║\n";
    echo $bold . $ciano . "╚═══════════════════════════════════════════════════════════════════╝\n\n" . $cln;

    echo $bold . $azul . "┌─────────────────────────────────────────────────────────────────┐\n";
    echo $bold . $azul . "│ [1] VERIFICANDO DISPOSITIVO CONECTADO                           │\n";
    echo $bold . $azul . "└─────────────────────────────────────────────────────────────────┘\n" . $cln;
    
    $devices = shell_exec('adb devices 2>&1');
    if (strpos($devices, 'device') === false || strpos($devices, 'unauthorized') !== false) {
        echo $bold . $vermelho . "[✗] Nenhum dispositivo detectado ou sem autorização!\n" . $cln;
        return false;
    }
    
    $check = shell_exec('adb shell "ls /sdcard 2>&1"');
    if (strpos($check, 'Permission denied') !== false) {
        echo $bold . $vermelho . "[✗] ADB sem permissões suficientes!\n" . $cln;
        return false;
    }
    
    echo $bold . $verde . "  ✓ Dispositivo conectado com permissões adequadas\n\n" . $cln;


    echo $bold . $azul . "┌─────────────────────────────────────────────────────────────────┐\n";
    echo $bold . $azul . "│ [2] VERIFICANDO ESTADO DE BOOT VERIFICADO                       │\n";
    echo $bold . $azul . "└─────────────────────────────────────────────────────────────────┘\n" . $cln;
    
    $verifiedBootState = trim(shell_exec('adb shell getprop ro.boot.verifiedbootstate 2>/dev/null'));
    
    if ($verifiedBootState === 'yellow') {
        echo $bold . $amarelo . "  ⚠ Boot State: YELLOW - Suspeita de modificação no sistema\n" . $cln;
        $bypassDetectado = true;
        $problemasEncontrados++;
    } elseif ($verifiedBootState === 'orange') {
        echo $bold . $vermelho . "  ✗ Boot State: ORANGE - Bootloader desbloqueado detectado\n" . $cln;
        $bypassDetectado = true;
        $problemasEncontrados++;
    } elseif ($verifiedBootState === 'green') {
        echo $bold . $verde . "  ✓ Boot State: GREEN - Sistema verificado\n" . $cln;
    } else {
        echo $bold . $amarelo . "  ⚠ Boot State: $verifiedBootState (Desconhecido)\n" . $cln;
    }
    $totalVerificacoes++;


    echo "\n" . $bold . $azul . "┌─────────────────────────────────────────────────────────────────┐\n";
    echo $bold . $azul . "│ [3] VERIFICANDO STATUS DO SELINUX                               │\n";
    echo $bold . $azul . "└─────────────────────────────────────────────────────────────────┘\n" . $cln;
    
    $selinux = trim(shell_exec('adb shell getenforce 2>/dev/null'));
    
    if ($selinux === 'Permissive') {
        echo $bold . $vermelho . "  ✗ SELinux: PERMISSIVE - Modo permissivo detectado (comum em dispositivos rooteados)\n" . $cln;
        $bypassDetectado = true;
        $problemasEncontrados++;
    } elseif ($selinux === 'Enforcing') {
        echo $bold . $verde . "  ✓ SELinux: ENFORCING - Modo de segurança ativo\n" . $cln;
    } else {
        echo $bold . $amarelo . "  ⚠ SELinux: $selinux (Status desconhecido)\n" . $cln;
    }
    $totalVerificacoes++;


    echo "\n" . $bold . $azul . "┌─────────────────────────────────────────────────────────────────┐\n";
    echo $bold . $azul . "│ [4] VERIFICANDO PROPRIEDADES DO SISTEMA                         │\n";
    echo $bold . $azul . "└─────────────────────────────────────────────────────────────────┘\n" . $cln;
    
    $propriedadesSuspeitas = [
        'ro.debuggable' => ['valor' => '1', 'descricao' => 'Modo debug ativado'],
        'ro.secure' => ['valor' => '0', 'descricao' => 'Segurança desativada'],
        'service.adb.root' => ['valor' => '1', 'descricao' => 'ADB root ativo'],
        'ro.build.selinux' => ['valor' => '0', 'descricao' => 'SELinux desabilitado'],
        'ro.boot.flash.locked' => ['valor' => '0', 'descricao' => 'Flash desbloqueado'],
        'ro.boot.veritymode' => ['valor' => 'disabled', 'descricao' => 'dm-verity desabilitado'],
        'sys.oem_unlock_allowed' => ['valor' => '1', 'descricao' => 'OEM unlock permitido'],
        'persist.sys.usb.config' => ['valor' => 'adb', 'descricao' => 'ADB persistente ativo'],
        'ro.kernel.qemu' => ['valor' => '1', 'descricao' => 'Emulador detectado'],
    ];

    foreach ($propriedadesSuspeitas as $prop => $info) {
        $valor = trim(shell_exec("adb shell getprop $prop 2>/dev/null"));
        if ($valor === $info['valor']) {
            echo $bold . $vermelho . "  ✗ Propriedade suspeita: $prop = $valor ({$info['descricao']})\n" . $cln;
            $bypassDetectado = true;
            $problemasEncontrados++;
        }
        $totalVerificacoes++;
    }
    
    echo $bold . $verde . "  ✓ Verificação de propriedades concluída\n" . $cln;


    echo "\n" . $bold . $azul . "┌─────────────────────────────────────────────────────────────────┐\n";
    echo $bold . $azul . "│ [5] VERIFICANDO BINÁRIOS SU (SUPERUSUÁRIO)                      │\n";
    echo $bold . $azul . "└─────────────────────────────────────────────────────────────────┘\n" . $cln;
    
    $binariosSU = [
        '/system/bin/su',
        '/system/xbin/su',
        '/sbin/su',
        '/system/su',
        '/system/bin/.ext/.su',
        '/data/local/su',
        '/data/local/bin/su',
        '/data/local/xbin/su',
        '/su/bin/su',
        '/system/sbin/su',
        '/vendor/bin/su',
        '/system/app/Superuser.apk',
        '/data/adb/magisk',
        '/data/adb/ksu', 
        '/data/adb/ap',   
        '/cache/su',
        '/dev/com.koushikdutta.superuser.daemon',
    ];
    
    $suEncontrado = false;
    foreach ($binariosSU as $bin) {
        $cmd = 'adb shell "test -f ' . escapeshellarg($bin) . ' && echo FOUND || echo NOTFOUND" 2>/dev/null';
        $result = trim(shell_exec($cmd) ?? '');
        if ($result === 'FOUND') {
            echo $bold . $vermelho . "  ✗ Binário SU encontrado: $bin\n" . $cln;
            $bypassDetectado = true;
            $suEncontrado = true;
            $problemasEncontrados++;
        }
        $totalVerificacoes++;
    }
    
    if (!$suEncontrado) {
        echo $bold . $verde . "  ✓ Nenhum binário SU encontrado\n" . $cln;
    }


    echo "\n" . $bold . $azul . "┌─────────────────────────────────────────────────────────────────┐\n";
    echo $bold . $azul . "│ [6] DETECÇÃO AVANÇADA DE MAGISK                                 │\n";
    echo $bold . $azul . "└─────────────────────────────────────────────────────────────────┘\n" . $cln;
    
    $magiskDetectado = false;
    
    $magiskPkgs = shell_exec('adb shell "pm list packages 2>/dev/null | grep -iE \'magisk|topjohnwu\'"');
    if ($magiskPkgs && !empty(trim($magiskPkgs))) {
        echo $bold . $vermelho . "  ✗ Pacote Magisk encontrado:\n" . $cln;
        echo $bold . $amarelo . "    " . trim($magiskPkgs) . "\n" . $cln;
        $bypassDetectado = true;
        $magiskDetectado = true;
        $problemasEncontrados++;
    }
    
    $magiskDirs = [
        '/data/adb/magisk',
        '/sbin/.magisk',
        '/data/adb/modules',
        '/cache/magisk.log'
    ];
    
    foreach ($magiskDirs as $dir) {
        $check = trim(shell_exec('adb shell "test -e ' . escapeshellarg($dir) . ' && echo FOUND || echo NOTFOUND" 2>/dev/null') ?? '');
        if ($check === 'FOUND') {
            echo $bold . $vermelho . "  ✗ Diretório/arquivo Magisk encontrado: $dir\n" . $cln;
            $bypassDetectado = true;
            $magiskDetectado = true;
            $problemasEncontrados++;
        }
        $totalVerificacoes++;
    }
    
    $magiskProcs = shell_exec('adb shell "ps -A 2>/dev/null | grep -iE \'magisk|magiskd\'"');
    if ($magiskProcs && !empty(trim($magiskProcs))) {
        echo $bold . $vermelho . "  ✗ Processo Magisk em execução:\n" . $cln;
        echo $bold . $amarelo . "    " . trim($magiskProcs) . "\n" . $cln;
        $bypassDetectado = true;
        $magiskDetectado = true;
        $problemasEncontrados++;
    }
    

    $magiskMounts = shell_exec('adb shell "mount 2>/dev/null | grep magisk"');
    if ($magiskMounts && !empty(trim($magiskMounts))) {
        echo $bold . $vermelho . "  ✗ Mountpoint Magisk detectado:\n" . $cln;
        echo $bold . $amarelo . "    " . trim($magiskMounts) . "\n" . $cln;
        $bypassDetectado = true;
        $magiskDetectado = true;
        $problemasEncontrados++;
    }
    
    if (!$magiskDetectado) {
        echo $bold . $verde . "  ✓ Nenhum vestígio de Magisk encontrado\n" . $cln;
    }

    echo "\n" . $bold . $azul . "┌─────────────────────────────────────────────────────────────────┐\n";
    echo $bold . $azul . "│ [7] DETECÇÃO DE KERNELSU                                        │\n";
    echo $bold . $azul . "└─────────────────────────────────────────────────────────────────┘\n" . $cln;
    
    $kernelsuDetectado = false;
    
    $kernelMod = shell_exec('adb shell "lsmod 2>/dev/null | grep -i kernelsu"');
    if ($kernelMod && !empty(trim($kernelMod))) {
        echo $bold . $vermelho . "  ✗ Módulo KernelSU no kernel:\n" . $cln;
        echo $bold . $amarelo . "    " . trim($kernelMod) . "\n" . $cln;
        $bypassDetectado = true;
        $kernelsuDetectado = true;
        $problemasEncontrados++;
    }
    
    $kernelsuFiles = [
        '/data/adb/ksud',
        '/data/adb/ksu',
        '/proc/kernelsu'
    ];
    
    foreach ($kernelsuFiles as $file) {
        $check = trim(shell_exec('adb shell "test -e ' . escapeshellarg($file) . ' && echo FOUND || echo NOTFOUND" 2>/dev/null') ?? '');
        if ($check === 'FOUND') {
            echo $bold . $vermelho . "  ✗ Arquivo/diretório KernelSU encontrado: $file\n" . $cln;
            $bypassDetectado = true;
            $kernelsuDetectado = true;
            $problemasEncontrados++;
        }
        $totalVerificacoes++;
    }
    
    $kernelVersion = shell_exec('adb shell "uname -r 2>/dev/null | grep -i ksu"');
    if ($kernelVersion && !empty(trim($kernelVersion))) {
        echo $bold . $vermelho . "  ✗ Kernel modificado com KernelSU:\n" . $cln;
        echo $bold . $amarelo . "    " . trim($kernelVersion) . "\n" . $cln;
        $bypassDetectado = true;
        $kernelsuDetectado = true;
        $problemasEncontrados++;
    }
    
    if (!$kernelsuDetectado) {
        echo $bold . $verde . "  ✓ Nenhum vestígio de KernelSU encontrado\n" . $cln;
    }


    echo "\n" . $bold . $azul . "┌─────────────────────────────────────────────────────────────────┐\n";
    echo $bold . $azul . "│ [8] DETECÇÃO DE APATCH                                          │\n";
    echo $bold . $azul . "└─────────────────────────────────────────────────────────────────┘\n" . $cln;
    
    $apatchDetectado = false;
    
    $apatchPkgs = shell_exec('adb shell "pm list packages 2>/dev/null | grep -i apatch"');
    if ($apatchPkgs && !empty(trim($apatchPkgs))) {
        echo $bold . $vermelho . "  ✗ Pacote APatch encontrado:\n" . $cln;
        echo $bold . $amarelo . "    " . trim($apatchPkgs) . "\n" . $cln;
        $bypassDetectado = true;
        $apatchDetectado = true;
        $problemasEncontrados++;
    }
    
    $apatchDir = trim(shell_exec('adb shell "test -d /data/adb/ap && echo FOUND || echo NOTFOUND" 2>/dev/null') ?? '');
    if ($apatchDir === 'FOUND') {
        echo $bold . $vermelho . "  ✗ Diretório APatch encontrado: /data/adb/ap\n" . $cln;
        $bypassDetectado = true;
        $apatchDetectado = true;
        $problemasEncontrados++;
    }
    
    $apatchProp = shell_exec('adb shell "getprop 2>/dev/null | grep -i apatch"');
    if ($apatchProp && !empty(trim($apatchProp))) {
        echo $bold . $vermelho . "  ✗ Propriedade APatch encontrada:\n" . $cln;
        echo $bold . $amarelo . "    " . trim($apatchProp) . "\n" . $cln;
        $bypassDetectado = true;
        $apatchDetectado = true;
        $problemasEncontrados++;
    }
    
    if (!$apatchDetectado) {
        echo $bold . $verde . "  ✓ Nenhum vestígio de APatch encontrado\n" . $cln;
    }

    echo "\n" . $bold . $azul . "┌─────────────────────────────────────────────────────────────────┐\n";
    echo $bold . $azul . "│ [9] ANÁLISE DE LOGS DO KERNEL E SISTEMA                         │\n";
    echo $bold . $azul . "└─────────────────────────────────────────────────────────────────┘\n" . $cln;
    
    $logChecks = [
        'Logcat Kernel' => 'adb shell "logcat -b kernel -d 2>/dev/null | grep -iE \'kernelsu|magisk|apatch\'"',
        'Dumpsys Package' => 'adb shell "dumpsys package 2>/dev/null | grep -iE \'kernelsu|magisk|apatch\' | grep -v queriesPackages | grep -vE \'KernelSupport|Freecess|ChinaPolicy\'"',
        'Dumpsys Activity' => 'adb shell "dumpsys activity 2>/dev/null | grep -iE \'kernelsu|magisk|apatch\' | grep -v queriesPackages | grep -vE \'KernelSupport|Freecess|ChinaPolicy\'"',
        'Dumpsys Processes' => 'adb shell "dumpsys activity processes 2>/dev/null | grep -iE \'kernelsu|magisk|apatch\'"'
    ];

    $logDetectado = false;
    foreach ($logChecks as $checkName => $cmd) {
        $output = shell_exec($cmd);
        if ($output && !empty(trim($output))) {
            echo $bold . $vermelho . "  ✗ Root detectado em $checkName:\n" . $cln;
            echo $bold . $amarelo . "    " . substr(trim($output), 0, 200) . "...\n" . $cln;
            $bypassDetectado = true;
            $logDetectado = true;
            $problemasEncontrados++;
        }
        $totalVerificacoes++;
    }
    
    if (!$logDetectado) {
        echo $bold . $verde . "  ✓ Logs do sistema limpos\n" . $cln;
    }

    echo "\n" . $bold . $azul . "┌─────────────────────────────────────────────────────────────────┐\n";
    echo $bold . $azul . "│ [10] DETECÇÃO DE FRAMEWORKS DE HOOK                            │\n";
    echo $bold . $azul . "└─────────────────────────────────────────────────────────────────┘\n" . $cln;
    
    $hookFrameworks = [
        'Xposed' => [
            'adb shell "pm list packages 2>/dev/null | grep -iE \'xposed|exposed\'"',
            'adb shell "test -f /system/framework/XposedBridge.jar && echo FOUND || echo NOTFOUND"'
        ],
        'LSPosed' => [
            'adb shell "pm list packages 2>/dev/null | grep -i lsposed"',
            'adb shell "test -d /data/adb/lspd && echo FOUND || echo NOTFOUND"'
        ],
        'EdXposed' => [
            'adb shell "pm list packages 2>/dev/null | grep -i edxposed"'
        ],
        'Frida' => [
            'adb shell "ps -A 2>/dev/null | grep frida"',
            'adb shell "netstat -tunlp 2>/dev/null | grep 27042"'
        ],
        'Substrate' => [
            'adb shell "pm list packages 2>/dev/null | grep -i substrate"'
        ]
    ];

    $hookDetectado = false;
    foreach ($hookFrameworks as $framework => $checks) {
        foreach ($checks as $check) {
            $output = shell_exec($check);
            $outputTrim = trim($output ?? '');

            $encontrado = false;
            
            if (!empty($outputTrim)) {
                if (strpos($check, 'FOUND') !== false) {
        
                    if ($outputTrim === 'FOUND') {
                        $encontrado = true;
                    }
                } else {

                    $encontrado = true;
                }
            }
            
            if ($encontrado) {
                echo $bold . $vermelho . "  ✗ Framework de hook detectado: $framework\n" . $cln;
                echo $bold . $amarelo . "    Detalhes: " . substr($outputTrim, 0, 100) . "\n" . $cln;
                $bypassDetectado = true;
                $hookDetectado = true;
                $problemasEncontrados++;
                break;
            }
            $totalVerificacoes++;
        }
    }
    
    if (!$hookDetectado) {
        echo $bold . $verde . "  ✓ Nenhum framework de hook detectado\n" . $cln;
    }

    echo "\n" . $bold . $azul . "┌─────────────────────────────────────────────────────────────────┐\n";
    echo $bold . $azul . "│ [11] VERIFICANDO FUNÇÕES SHELL SOBRESCRITAS                     │\n";
    echo $bold . $azul . "└─────────────────────────────────────────────────────────────────┘\n" . $cln;
    
    $funcoesTeste = [
        'pkg' => 'adb shell "type pkg 2>/dev/null | grep -q function && echo FUNCTION_DETECTED"',
        'git' => 'adb shell "type git 2>/dev/null | grep -q function && echo FUNCTION_DETECTED"', 
        'cd' => 'adb shell "type cd 2>/dev/null | grep -q function && echo FUNCTION_DETECTED"',
        'stat' => 'adb shell "type stat 2>/dev/null | grep -q function && echo FUNCTION_DETECTED"',
        'adb' => 'adb shell "type adb 2>/dev/null | grep -q function && echo FUNCTION_DETECTED"',
        'ls' => 'adb shell "type ls 2>/dev/null | grep -q function && echo FUNCTION_DETECTED"',
        'cat' => 'adb shell "type cat 2>/dev/null | grep -q function && echo FUNCTION_DETECTED"',
        'pm' => 'adb shell "type pm 2>/dev/null | grep -q function && echo FUNCTION_DETECTED"'
    ];
    
    $funcaoSobrescrita = false;
    foreach ($funcoesTeste as $funcao => $comando) {
        $resultado = shell_exec($comando);
        if ($resultado !== null && strpos($resultado, 'FUNCTION_DETECTED') !== false) {
            echo $bold . $vermelho . "  ✗ BYPASS DETECTADO: Função '$funcao' foi sobrescrita!\n" . $cln;
            $bypassDetectado = true;
            $funcaoSobrescrita = true;
            $problemasEncontrados++;
        }
        $totalVerificacoes++;
    }
    
    if (!$funcaoSobrescrita) {
        echo $bold . $verde . "  ✓ Todas as funções shell estão normais\n" . $cln;
    }

    echo "\n" . $bold . $azul . "┌─────────────────────────────────────────────────────────────────┐\n";
    echo $bold . $azul . "│ [12] TESTANDO ACESSO A DIRETÓRIOS CRÍTICOS                      │\n";
    echo $bold . $azul . "└─────────────────────────────────────────────────────────────────┘\n" . $cln;
    
    $diretoriosCriticos = [
        '/system/bin' => 'Binários do sistema',
        '/data/data/com.dts.freefireth/files' => 'Dados Free Fire TH',
        '/data/data/com.dts.freefiremax/files' => 'Dados Free Fire MAX',
        '/storage/emulated/0/Android/data' => 'Dados de aplicativos',
        '/data/adb' => 'Diretório ADB',
        '/system/xbin' => 'Binários estendidos'
    ];
    
    $acessoBloqueado = false;
    foreach ($diretoriosCriticos as $diretorio => $descricao) {
        $comandoTestDir = 'adb shell "ls -la \"' . $diretorio . '\" 2>&1 | head -3"';
        $resultadoTestDir = shell_exec($comandoTestDir);
        
        if (empty($resultadoTestDir) || trim($resultadoTestDir ?? '') === '') {
            echo $bold . $amarelo . "  ⚠ Sem resposta do diretório: $diretorio ($descricao)\n" . $cln;
        } elseif (($resultadoTestDir !== null && strpos($resultadoTestDir, 'blocked') !== false) ||
                  ($resultadoTestDir !== null && strpos($resultadoTestDir, 'redirected') !== false) ||
                  ($resultadoTestDir !== null && strpos($resultadoTestDir, 'bypass') !== false)) {
            
            echo $bold . $vermelho . "  ✗ BYPASS DETECTADO: Acesso bloqueado/redirecionado\n" . $cln;
            echo $bold . $amarelo . "    Diretório: $diretorio ($descricao)\n" . $cln;
            echo $bold . $amarelo . "    Resposta: " . substr(trim($resultadoTestDir ?? ''), 0, 100) . "\n" . $cln;
            $bypassDetectado = true;
            $acessoBloqueado = true;
            $problemasEncontrados++;
        }
        $totalVerificacoes++;
    }
    
    if (!$acessoBloqueado) {
        echo $bold . $verde . "  ✓ Acesso aos diretórios está normal\n" . $cln;
    }

    echo "\n" . $bold . $azul . "┌─────────────────────────────────────────────────────────────────┐\n";
    echo $bold . $azul . "│ [13] VERIFICANDO PROCESSOS SUSPEITOS                            │\n";
    echo $bold . $azul . "└─────────────────────────────────────────────────────────────────┘\n" . $cln;
    
    $comandoProcessos = 'adb shell "ps -A 2>/dev/null | grep -E \"(bypass|redirect|fake|hide|cloak|stealth)\" | grep -vE \"(drm_fake_vsync|mtk_drm_fake_vsync|mtk_drm_fake_vs)\" 2>/dev/null"';
    $resultadoProcessos = shell_exec($comandoProcessos);
    
    if ($resultadoProcessos !== null && !empty(trim($resultadoProcessos))) {
        $linhasProcessos = explode("\n", trim($resultadoProcessos));
        $processosSuspeitos = [];
        
        foreach ($linhasProcessos as $linha) {
            if (!empty(trim($linha)) && 
                strpos($linha, '[kblockd]') === false && 
                strpos($linha, 'kworker') === false &&
                strpos($linha, '[ksoftirqd]') === false &&
                strpos($linha, '[migration]') === false &&
                strpos($linha, 'mtk_drm_fake_vsync') === false &&
                strpos($linha, 'mtk_drm_fake_vs') === false &&
                strpos($linha, 'drm_fake_vsync') === false) {
                $processosSuspeitos[] = $linha;
            }
        }
        
        if (!empty($processosSuspeitos)) {
            echo $bold . $vermelho . "  ✗ PROCESSOS SUSPEITOS DETECTADOS:\n" . $cln;
            foreach ($processosSuspeitos as $proc) {
                echo $bold . $amarelo . "    • " . $proc . "\n" . $cln;
            }
            $bypassDetectado = true;
            $problemasEncontrados++;
        } else {
            echo $bold . $verde . "  ✓ Nenhum processo suspeito encontrado\n" . $cln;
        }
    } else {
        echo $bold . $verde . "  ✓ Nenhum processo suspeito encontrado\n" . $cln;
    }
    $totalVerificacoes++;

    echo "\n" . $bold . $azul . "┌─────────────────────────────────────────────────────────────────┐\n";
    echo $bold . $azul . "│ [14] VERIFICAÇÃO DE REDE E APPS SUSPEITOS                       │\n";
    echo $bold . $azul . "└─────────────────────────────────────────────────────────────────┘\n" . $cln;


    $interfaces = shell_exec('adb shell "ip link 2>/dev/null | grep -E \'tun0|ppp0|wg0\'"');
    if ($interfaces && !empty(trim($interfaces))) {
        echo $bold . $vermelho . "  ✗ VPN/Tunelamento Detectado (Pode ocultar tráfego):\n" . $cln;
        echo $bold . $amarelo . "    " . trim($interfaces) . "\n" . $cln;
        $bypassDetectado = true;
        $problemasEncontrados++;
    } else {
        echo $bold . $verde . "  ✓ Nenhuma interface VPN ativa encontrada\n" . $cln;
    }

    $privateDns = trim(shell_exec('adb shell "settings get global private_dns_mode 2>/dev/null"'));
    $dns1 = trim(shell_exec('adb shell "getprop net.dns1 2>/dev/null"'));
    
    if ($privateDns === 'hostname' || ($privateDns !== 'off' && $privateDns !== 'null' && !empty($privateDns))) {
        echo $bold . $amarelo . "  ⚠ DNS Privado Ativo (Mode: $privateDns) - Verifique se não bloqueia logs\n" . $cln;
        $problemasEncontrados++;
    } elseif (in_array($dns1, ['1.1.1.1', '8.8.8.8', '9.9.9.9'])) {
        echo $bold . $amarelo . "  ⚠ DNS Público Detectado ($dns1) - Atenção para redirecionamentos\n" . $cln;
    } else {
        echo $bold . $verde . "  ✓ Configuração de DNS aparentemente normal\n" . $cln;
    }

    $appsSuspeitos = [
        'moe.shizuku.privileged.api' => 'Shizuku (API)',
        'shizuku.service' => 'Shizuku (Service)',
        'com.lexa.fakegps' => 'Fake GPS',
        'com.incorporateapps.fakegps.fre' => 'Fake GPS Free',
        'com.lbe.parallel' => 'Parallel Space',
        'com.excelliance.multiaccounts' => 'Multi Accounts',
        'trickystore' => 'TrickyStore (Bypass)',
        'shamiko' => 'Shamiko (Hide Root)'
    ];

    $pacotesInstalados = shell_exec('adb shell "pm list packages 2>/dev/null"');
    $appDetectado = false;

    if ($pacotesInstalados) {
        foreach ($appsSuspeitos as $pkg => $nome) {
            if (strpos($pacotesInstalados, $pkg) !== false) {
                echo $bold . $amarelo . "  ⚠ App Suspeito Instalado: $nome ($pkg)\n" . $cln;
                $appDetectado = true;
                $problemasEncontrados++;
            }
        }
    }

    if (!$appDetectado) {
        echo $bold . $verde . "  ✓ Nenhum app de manipulação conhecido encontrado\n" . $cln;
    }

    $tmpFiles = shell_exec('adb shell "ls -A /data/local/tmp 2>/dev/null"');
    if ($tmpFiles && !empty(trim($tmpFiles))) {
        echo $bold . $amarelo . "  ⚠ Arquivos encontrados em /data/local/tmp (Local comum para exploits):\n" . $cln;
        $files = explode("\n", trim($tmpFiles));
        $count = 0;
        foreach ($files as $f) {
            if ($count < 5) echo $bold . $amarelo . "    • $f\n" . $cln;
            $count++;
        }
        if (count($files) > 5) echo $bold . $amarelo . "    • ... e mais " . (count($files) - 5) . " arquivos\n" . $cln;
        $problemasEncontrados++;
    } else {
        echo $bold . $verde . "  ✓ Pasta /data/local/tmp limpa\n" . $cln;
    }
    $totalVerificacoes++;

    echo "\n" . $bold . $ciano . "╔═══════════════════════════════════════════════════════════════════╗\n";
    echo $bold . $ciano . "║                    RESUMO DA ANÁLISE                              ║\n";
    echo $bold . $ciano . "╚═══════════════════════════════════════════════════════════════════╝\n\n" . $cln;
    
    echo $bold . $branco . "Total de verificações realizadas: " . $totalVerificacoes . "\n";
    echo $bold . $branco . "Problemas encontrados: " . $problemasEncontrados . "\n\n";
    
    if ($bypassDetectado) {
        echo $bold . $vermelho . "╔══════════════════════════════════════════════════════════════════╗\n";
        echo $bold . $vermelho . "║                    ⚠️  ATENÇÃO ⚠️                                 ║\n";
        echo $bold . $vermelho . "║                                                                  ║\n";
        echo $bold . $vermelho . "║  MODIFICAÇÕES DE SEGURANÇA DETECTADAS NO DISPOSITIVO!           ║\n";
        echo $bold . $vermelho . "║  Root, bypass ou hooks foram identificados.                     ║\n";
        echo $bold . $vermelho . "║  Verifique os detalhes acima e tome as medidas necessárias.     ║\n";
        echo $bold . $vermelho . "║                                                                  ║\n";
        echo $bold . $vermelho . "╚══════════════════════════════════════════════════════════════════╝\n" . $cln;
    } else {
        echo $bold . $verde . "╔══════════════════════════════════════════════════════════════════╗\n";
        echo $bold . $verde . "║                    ✓ VERIFICAÇÃO CONCLUÍDA ✓                     ║\n";
        echo $bold . $verde . "║                                                                  ║\n";
        echo $bold . $verde . "║  Nenhuma modificação de segurança crítica foi detectada.         ║\n";
        echo $bold . $verde . "║  O dispositivo parece estar em condições normais.                ║\n";
        echo $bold . $verde . "║                                                                  ║\n";
        echo $bold . $verde . "╚══════════════════════════════════════════════════════════════════╝\n" . $cln;
    }
    
    echo "\n";
    
    return $bypassDetectado;
}


function escanearFreeFire($pacote, $nomeJogo) {
    global $bold, $vermelho, $amarelo, $fverde, $azul, $branco, $cln, $verde, $ciano, $laranja, $cinza;

    $binaries = [
        '/data/data/com.termux/files/usr/bin/adb',
        '/data/data/com.termux/files/usr/bin/clear'
    ];
    foreach ($binaries as $bin) {
        if (file_exists($bin)) {
            @chmod($bin, 0755);
        }
    }

    system("clear");
    keller_banner();
    verificarDispositivoADB();

    if (!shell_exec("adb version > /dev/null 2>&1")) {
        system("pkg install -y android-tools > /dev/null 2>&1");
    }

    date_default_timezone_set('America/Sao_Paulo');
    shell_exec('adb start-server > /dev/null 2>&1');

    $comandoDispositivos = shell_exec("adb devices 2>&1");

    if (empty($comandoDispositivos) || strpos($comandoDispositivos, "device") === false || strpos($comandoDispositivos, "no devices") !== false) {
        echo "\033[1;31m[!] Nenhum dispositivo encontrado. Faça o pareamento de IP ou conecte um dispositivo via USB.\n\n";
        exit;
    }

    $comandoVerificarFF = shell_exec("adb shell pm list packages --user 0 | grep " . escapeshellarg($pacote) . " 2>&1");

    if (!empty($comandoVerificarFF) && strpos($comandoVerificarFF, "more than one device/emulator") !== false) {
        echo $bold . $vermelho . "  ✗ Pareamento realizado de maneira incorreta, digite \"adb disconnect\" e refaça o processo.\n\n";
        exit;
    }
    
    if (!empty($comandoVerificarFF) && strpos($comandoVerificarFF, $pacote) !== false) {
    } else {
        echo $bold . $vermelho . "  ✗ O $nomeJogo está desinstalado, cancelando a telagem...\n\n";
        exit;
    }

    $comandoVersaoAndroid = "adb shell getprop ro.build.version.release";
    $resultadoVersaoAndroid = shell_exec($comandoVersaoAndroid);

    if (!empty($resultadoVersaoAndroid)) {
        echo $bold . $azul . "[+] Versão do Android: " . trim($resultadoVersaoAndroid) . "\n";
    } else {
        echo $bold . $vermelho . "  ✗ Não foi possível obter a versão do Android.\n";
    }

    $comandoSu = 'su 2>&1';
    $resultadoSu = shell_exec($comandoSu);

    echo $bold . $azul . "  → Checando se possui Root (se o programa travar, root detectado)...\n";
    if (!empty($resultadoSu) && strpos($resultadoSu, 'No su program found') !== false) {
        echo $bold . $fverde . "[-] O dispositivo não tem root.\n\n";
    } else {
        echo $bold . $vermelho . "[+] Root detectado no dispositivo Android.\n\n";
    }
    
    echo $bold . $azul . "  → Verificando scripts ativos em segundo plano...\n";
    $comandoScripts = 'adb shell "pgrep -a bash | awk \'{\$1=\"\"; sub(/^ /,\"\"); print}\' | grep -vFx \"/data/data/com.termux/files/usr/bin/bash -l\""';
    $scriptsAtivos = shell_exec($comandoScripts);
    
    if ($scriptsAtivos !== null && trim($scriptsAtivos) !== '') {
        echo $bold . $vermelho . "  ✗ Scripts detectados rodando em segundo plano! Cancelando scanner...\n";
        echo $bold . $amarelo . "Scripts encontrados:\n" . trim($scriptsAtivos) . "\n\n";
        exit;
    }
    
    echo $bold . $fverde . "  ℹ Nenhum script ativo detectado.\n";
    echo $bold . $azul . "[+] Finalizando sessões bash desnecessárias...\n";
    $comandoKillBash = 'adb shell "current_pid=\$\$; for pid in \$(pgrep bash); do [ \"\$pid\" -ne \"\$current_pid\" ] && kill -9 \$pid; done"';
    shell_exec($comandoKillBash);
    echo $bold . $fverde . "  ℹ Sessões desnecessárias finalizadas.\n\n";

    echo $bold . $azul . "  → Verificando bypasses de funções shell...\n";
    detectarBypassShell();

    echo $bold . $azul . "  → Checando se o dispositivo foi reiniciado recentemente...\n";
    $comandoUPTIME = shell_exec("adb shell uptime");

    if (preg_match('/up (\d+) min/', $comandoUPTIME, $filtros)) {
        $minutos = $filtros[1];
        echo $bold . $vermelho . "  ✗ O dispositivo foi iniciado recentemente (há $minutos minutos).\n\n";
    } else {
        echo $bold . $fverde . "  ℹ Dispositivo não reiniciado recentemente.\n\n";
    }

    $logcatTime = shell_exec("adb logcat -d -v time | head -n 2");
    preg_match('/(\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $logcatTime, $matchTime);

    if (!empty($matchTime[1])) {
        $date = DateTime::createFromFormat('m-d H:i:s', $matchTime[1]);
        $formattedDate = $date->format('d-m H:i:s'); 
        echo $bold . $amarelo . "  → Primeira log do sistema: " . $formattedDate . "\n";
        echo $bold . $branco . "  → Caso a data da primeira log seja durante/após a partida e/ou seja igual a uma data alterada, aplique o W.O!\n\n";
    } else {
        echo $bold . $vermelho . "  ✗ Não foi possível capturar a data/hora do sistema.\n\n";
    }
    
    echo $bold . $azul . "  → Verificando mudanças de data/hora...\n";
    $logcatOutput = shell_exec('adb logcat -d | grep "UsageStatsService: Time changed" | grep -v "HCALL"');

    if ($logcatOutput !== null && trim($logcatOutput) !== "") {
        $logLines = explode("\n", trim($logcatOutput));
    } else {
        echo $bold . $vermelho . "  ✗ Erro ao obter logs de modificação de data/hora, verifique a data da primeira log do sistema.\n\n";
    }

    $fusoHorario = trim(shell_exec('adb shell getprop persist.sys.timezone'));

    if ($fusoHorario !== "America/Sao_Paulo") {
        echo $bold . $amarelo . "  ⚠ Aviso: O fuso horário do dispositivo é '$fusoHorario', diferente de 'America/Sao_Paulo', possivel tentativa de Bypass.\n\n";
    }

    $dataAtual = date("m-d");
    $logsAlterados = [];

    if (!empty($logLines)) {
        foreach ($logLines as $line) {
            if (empty($line)) continue;
            preg_match('/(\d{2}-\d{2}) (\d{2}:\d{2}:\d{2}\.\d{3}).*Time changed in.*by (-?\d+) second/', $line, $matches);

            if (!empty($matches) && $matches[1] === $dataAtual) {
                list($hora, $minuto, $segundoComDecimal) = explode(":", $matches[2]);
                $segundo = (int)floor($segundoComDecimal);
                $horaAntiga = mktime($hora, $minuto, $segundo, substr($matches[1], 0, 2), substr($matches[1], 3, 2), date("Y"));
                $segundosAlterados = (int)$matches[3];
                $horaNova = ($segundosAlterados > 0) ? $horaAntiga - $segundosAlterados : $horaAntiga + abs($segundosAlterados);
                $dataAntiga = date("d-m H:i", $horaAntiga);
                $horaAntigaFormatada = date("H:i", $horaAntiga);
                $horaNovaFormatada = date("H:i", $horaNova);
                $dataNova = date("d-m", $horaNova);

                $logsAlterados[] = [
                    'horaAntiga' => $horaAntiga,
                    'horaNova' => $horaNova,
                    'horaAntigaFormatada' => $horaAntigaFormatada,
                    'horaNovaFormatada' => $horaNovaFormatada,
                    'acao' => ($segundosAlterados > 0) ? 'Atrasou' : 'Adiantou',
                    'dataAntiga' => $dataAntiga,
                    'dataNova' => $dataNova
                ];
            }
        }
    }

    if (!empty($logsAlterados)) {
        usort($logsAlterados, function ($a, $b) {
            return $b['horaAntiga'] - $a['horaAntiga'];
        });

        foreach ($logsAlterados as $log) {
            echo $bold . $amarelo . "  ⚠ Alterou horário de {$log['dataAntiga']} para {$log['dataNova']} {$log['horaNovaFormatada']} ({$log['acao']} horário)\n";
        }
    } else {
        echo $bold . $vermelho . "  ✗ Nenhum log de alteração de horário encontrado.\n\n";
    }

    echo $bold . $azul . "\n[+] Checando se modificou data e hora...\n";
    $autoTime = trim(shell_exec('adb shell settings get global auto_time'));
    $autoTimeZone = trim(shell_exec('adb shell settings get global auto_time_zone'));

    if ($autoTime !== "1" || $autoTimeZone !== "1") {
        echo $bold . $vermelho . "  ✗ Possível bypass detectado: data e hora/furo horário automático desativado.\n";
    } else {
        echo $bold . $fverde . "  ℹ Data e hora/fuso horário automático estão ativados.\n";
    }

    echo $bold . $branco . "  → Caso haja mudança de horário durante/após a partida, aplique o W.O!\n\n";

    echo $bold . $azul . "[+] Obtendo os últimos acessos do Google Play Store...\n";
    $comandoUSAGE = shell_exec("adb shell dumpsys usagestats 2>/dev/null | grep -i 'MOVE_TO_FOREGROUND' 2>/dev/null | grep 'package=com.android.vending' 2>/dev/null | awk -F'time=\"' '{print \$2}' 2>/dev/null | awk '{gsub(/\"/, \"\"); print \$1, \$2}' 2>/dev/null | tail -n 5 2>/dev/null");

    if (!is_null($comandoUSAGE) && trim($comandoUSAGE) !== "") {
        echo $bold . $fverde . "  ℹ Últimos 5 acessos:\n";
        echo $amarelo . $comandoUSAGE . "\n";
    } else {
        echo $bold . "\e[31m[!] Nenhum dado encontrado.\n";
    }
    echo $bold . $branco . "  → Caso haja acesso durante/após a partida, aplique o W.O!\n\n";

    echo $bold . $azul . "[+] Obtendo os últimos textos copiados...\n";
    $comando = "adb logcat -d 2>/dev/null | grep 'hcallSetClipboardTextRpc' 2>/dev/null | sed -E 's/^([0-9]{2}-[0-9]{2}) ([0-9]{2}:[0-9]{2}:[0-9]{2}).*hcallSetClipboardTextRpc\\(([^)]*)\\).*$/\\1 \\2 \\3/' 2>/dev/null | tail -n 10 2>/dev/null";
    $saida = shell_exec($comando);

    if (!is_null($saida)) {
        $linhas = explode("\n", trim($saida));
        foreach ($linhas as $linha) {
            if (!empty($linha) && preg_match('/^([0-9]{2}-[0-9]{2}) ([0-9]{2}:[0-9]{2}:[0-9]{2}) (.+)$/', $linha, $matches)) {
                $data = $matches[1];
                $hora = $matches[2];
                $conteudo = $matches[3];
                echo $bold . $amarelo . "  ⚠ " . $data . " " . $hora . " " . $branco . "$conteudo" . "\n";
            }
        }
    } else {
        echo $bold . "\e[31m[!] Nenhum dado encontrado.\n";
    }
    echo "\n";

    echo $bold . $azul . "  → Checando se o replay foi passado...\n";

    $comandoArquivos = 'adb shell "ls -t /sdcard/Android/data/' . $pacote . '/files/MReplays/*.bin 2>/dev/null"';
    $output = shell_exec($comandoArquivos) ?? '';
    $arquivos = array_filter(explode("\n", trim($output)));
    
    $motivos = [];
    $arquivoMaisRecente = null;
    $ultimoModifyTime = null;
    $ultimoChangeTime = null;
    
    if (empty($arquivos)) {
        $motivos[] = "Motivo 10 - Nenhum arquivo .bin encontrado na pasta MReplays";
    }
    
    foreach ($arquivos as $indice => $arquivo) {
        $resultadoStat = shell_exec('adb shell "stat ' . escapeshellarg($arquivo) . '"');
        if (
            preg_match('/Access: (.*?)\n/', $resultadoStat, $matchAccess) &&
            preg_match('/Modify: (.*?)\n/', $resultadoStat, $matchModify) &&
            preg_match('/Change: (.*?)\n/', $resultadoStat, $matchChange)
        ) {
            $dataAccess = trim(preg_replace('/ -\d{4}$/', '', $matchAccess[1]));
            $dataModify = trim(preg_replace('/ -\d{4}$/', '', $matchModify[1]));
            $dataChange = trim(preg_replace('/ -\d{4}$/', '', $matchChange[1]));
            
            $timestamps = [
                'Access' => $matchAccess[1],
                'Modify' => $matchModify[1],
                'Change' => $matchChange[1]
            ];
            
            $modifyTime = strtotime($dataModify);
            
            if ($indice === 0) {
                $arquivoMaisRecente = $arquivo;
                $ultimoModifyTime = $modifyTime;
                $ultimoChangeTime = strtotime($dataChange);
                
       
                if ($dataAccess === $dataModify) {
                    $motivos[] = "Motivo 1 - Access e Modify iguais no arquivo mais recente: " . basename($arquivo);
                }
                
          
                if ($dataModify !== $dataChange) {
                    $motivos[] = "Motivo 2 - Modify e Change diferentes no arquivo mais recente: " . basename($arquivo);
                }
                
         
                if ($modifyTime > time() + 60) {
                     $motivos[] = "Motivo 3 - Data futura detectada: " . basename($arquivo);
                }
            }
            
            if ($indice < 3) {
                $tresHorasAtras = time() - (3 * 3600);
                
                if ($modifyTime >= $tresHorasAtras) {

                    $jsonPath = str_replace('.bin', '.json', $arquivo);
                    $conteudoJson = shell_exec('adb shell "cat ' . escapeshellarg($jsonPath) . ' 2>/dev/null"');
                    
                    if ($conteudoJson && preg_match('/"Version":"(.*?)"/', $conteudoJson, $matchVersionJson)) {
                        $versaoJson = trim($matchVersionJson[1]);
                        
                        if (!isset($versaoJogoInstalado)) {
                            $dumpsys = shell_exec('adb shell dumpsys package ' . escapeshellarg($pacote));
                            if ($dumpsys && preg_match('/versionName=([\d\.]+)/', $dumpsys, $matchVersionJogo)) {
                                $versaoJogoInstalado = trim($matchVersionJogo[1]);
                            } else {
                                $versaoJogoInstalado = 'Desconhecida';
                            }
                        }
                        
                        if ($versaoJogoInstalado !== 'Desconhecida' && !empty($versaoJson)) {
 
                            $normVersion = function($v) {
                                $p = explode('.', $v);
                                $last = end($p);
                                if (strlen($last) >= 2) {
                                    $p[count($p)-1] = substr($last, 0, 1);
                                }
                                return implode('.', $p);
                            };

                            if ($normVersion($versaoJson) !== $normVersion($versaoJogoInstalado)) {
                                $motivos[] = "Motivo 14 - Replay recente (" . date('H:i', $modifyTime) . ") não é do dispositivo: " . basename($jsonPath);
                            }
                        }
                    }
                }
            }
        }
    }
    

    $pastaMReplays = "/sdcard/Android/data/" . $pacote . "/files/MReplays";
    $resultadoPasta = shell_exec('adb shell "stat ' . escapeshellarg($pastaMReplays) . ' 2>/dev/null"');
    
    if (
        preg_match('/Access: (.*?)\n/', $resultadoPasta, $matchAccessPasta) &&
        preg_match('/Modify: (.*?)\n/', $resultadoPasta, $matchModifyPasta) &&
        preg_match('/Change: (.*?)\n/', $resultadoPasta, $matchChangePasta)
    ) {
        $dataAccessPasta = trim(preg_replace('/ -\d{4}$/', '', $matchAccessPasta[1]));
        $dataModifyPasta = trim(preg_replace('/ -\d{4}$/', '', $matchModifyPasta[1]));
        $dataChangePasta = trim(preg_replace('/ -\d{4}$/', '', $matchChangePasta[1]));
        
        $timestamps = [
            'Access' => $matchAccessPasta[1],
            'Modify' => $matchModifyPasta[1],
            'Change' => $matchChangePasta[1]
        ];
        

        if ($dataAccessPasta === $dataModifyPasta) {
            $motivos[] = "Motivo 4 - Access e Modify iguais na pasta MReplays";
        }
        

        if ($dataModifyPasta !== $dataChangePasta) {
             $motivos[] = "Motivo 5 - Modify e Change diferentes na pasta MReplays";
        }
        

        if ($ultimoModifyTime && strtotime($dataModifyPasta) < $ultimoModifyTime - 10) { 
             $motivos[] = "Motivo 6 - Pasta modificada antes do arquivo mais recente";
        }

        if ($arquivoMaisRecente && isset($timestamps['Access'])) {
            if (preg_match('/(\d{4}-\d{2}-\d{2}-\d{2}-\d{2}-\d{2})/', basename($arquivoMaisRecente), $match)) {
                $nomeNormalizado = str_replace('-', '', $match[1]);
                $modifyPastaNormalizado = str_replace(['-', ' ', ':'], '', $timestamps['Modify']);
                if (preg_match('/\.(\d{2})(\d+)/', $timestamps['Access'], $milisegundosMatch)) {
                    $doisPrimeiros = (int)$milisegundosMatch[1];
                    $restante = $milisegundosMatch[2];
                    $todosZeros = preg_match('/^0+$/', $milisegundosMatch[0]);
                    $condicaoValida = ($doisPrimeiros <= 90 && preg_match('/^0+$/', $restante));
                    if (($todosZeros || $condicaoValida) && strpos($modifyPastaNormalizado, $nomeNormalizado) === false) { 

                    }
                }
            }
        }
    }
    

    $comandoLs = 'adb shell "ls -l /sdcard/Android/data/' . $pacote . '/files/MReplays/*.bin 2>/dev/null"';
    $outputLs = shell_exec($comandoLs) ?? '';
    $linhasLs = array_filter(explode("\n", trim($outputLs)));
    
    foreach ($linhasLs as $linha) {
        if (preg_match('/^-[rwx-]{9}\s+\d+\s+(\S+)\s+(\S+)\s+\d+\s+[\d-]+\s+[\d:]+\s+(.+\.bin)$/', $linha, $matches)) {
            $dono = $matches[1];
            $grupo = $matches[2];
            $nomeArquivo = basename($matches[3]);
            
            if ($dono === $grupo) {
                $motivos[] = "Motivo 13 - Dono e grupo iguais (suspeito): $nomeArquivo (dono: $dono, grupo: $grupo)";
            }
        }
    }

    if (!empty($motivos)) {
        echo $bold . $vermelho . "  ✗ Passador de replay detectado, aplique o W.O!\n";
        foreach (array_unique($motivos) as $motivo) {
            echo "    - " . $motivo . "\n";
        }
    } else {
        echo $bold . $fverde . "  ℹ Nenhum replay foi passado e a pasta MReplays está normal.\n";
    }

    if (!empty($resultadoPasta)) {
        preg_match('/Access: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d+)/', $resultadoPasta, $matchAccessPasta);
        
        if (!empty($matchAccessPasta[1])) {
            $dataAccessPasta = trim($matchAccessPasta[1]);
            $dataAccessPastaSemMilesimos = preg_replace('/\.\d+.*$/', '', $dataAccessPasta);
            
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dataAccessPastaSemMilesimos);
            $dataFormatada = $dateTime ? $dateTime->format('d-m-Y H:i:s') : $dataAccessPastaSemMilesimos;

            $cmd = "adb shell dumpsys package " . escapeshellarg($pacote) . " | grep -i firstInstallTime";
            $firstInstallTime = shell_exec($cmd);

            if (preg_match('/firstInstallTime=([\d-]+ \d{2}:\d{2}:\d{2})/', $firstInstallTime, $matches)) {
                $dataInstalacao = trim($matches[1]);
                $dateTimeInstalacao = DateTime::createFromFormat('Y-m-d H:i:s', $dataInstalacao);
                $dataInstalacaoFormatada = $dateTimeInstalacao ? $dateTimeInstalacao->format('d-m-Y H:i:s') : "Formato inválido";
            } else {
                $dataInstalacaoFormatada = "Não encontrada";
            }

            echo $bold . $amarelo . "  → Data de acesso da pasta MReplays: $dataFormatada\n";
            echo $bold . $amarelo . "  • Data de instalação do Free Fire: $dataInstalacaoFormatada\n";
            echo $bold . $branco . "  ▸ Verifique a data de instalação do jogo com a data de acesso da pasta MReplays para ver se o jogo foi recém instalado antes da partida, se não, vá no histórico e veja se o player jogou outras partidas recentemente, se sim, aplique o W.O!\n\n";
        } else {
            echo $bold . $vermelho . "  ✗ Não foi possível obter a data de acesso da pasta MReplays\n\n";
        }
    }

    echo $bold . $azul . "  → Checando bypass de Wallhack/Holograma...\n";

    $pastasParaVerificar = [
        "/sdcard/Android/data/" . $pacote . "/files/contentcache/Optional/android/gameassetbundles",
        "/sdcard/Android/data/" . $pacote . "/files/contentcache/Optional/android",
        "/sdcard/Android/data/" . $pacote . "/files/contentcache/Optional",
        "/sdcard/Android/data/" . $pacote . "/files/contentcache",
        "/sdcard/Android/data/" . $pacote . "/files",
        "/sdcard/Android/data/" . $pacote,
        "/sdcard/Android/data",
        "/sdcard/Android"
    ];

    $pastasParaVerificar2 = [
        "/sdcard/Android/data/" . $pacote . "/files/contentcache/Optional/android/gameassetbundles",
        "/sdcard/Android/data/" . $pacote . "/files/contentcache/Optional/android",
    ];

    $modificacaoDetectada = false;

    foreach ($pastasParaVerificar as $pasta) {
        $resultadoStat = shell_exec('adb shell "stat ' . escapeshellarg($pasta) . ' 2>/dev/null"');

        if (
            preg_match('/Access: (.*?)\n/', $resultadoStat, $matchAccess) &&
            preg_match('/Modify: (.*?)\n/', $resultadoStat, $matchModify) &&
            preg_match('/Change: (.*?)\n/', $resultadoStat, $matchChange)
        ) {
            $dataAccess = trim(preg_replace('/ -\d{4}$/', '', $matchAccess[1]));
            $dataModify = trim(preg_replace('/ -\d{4}$/', '', $matchModify[1]));
            $dataChange = trim(preg_replace('/ -\d{4}$/', '', $matchChange[1]));

            if ($dataModify !== $dataChange) {
                echo $bold . $vermelho . "  ✗ Modificação detectada na pasta: $pasta! Aplique o W.O!\n\n";
                $modificacaoDetectada = true;
            }
        }
    }

    if (!$modificacaoDetectada) {
        echo $bold . $fverde . "  ℹ Nenhuma modificação suspeita encontrada nas pastas principais.\n\n";
    }

    echo $bold . $azul . "  → Verificando arquivos específicos...\n";

    foreach ($pastasParaVerificar2 as $pasta) {
        $comandoListar = 'adb shell "ls ' . escapeshellarg($pasta) . ' 2>/dev/null"';
        $listaArquivos = shell_exec($comandoListar);

        if ($listaArquivos) {
            $arquivos = explode("\n", trim($listaArquivos));
            foreach ($arquivos as $arquivo) {
                if (empty($arquivo)) continue;

                $caminhoArquivo = $pasta . "/" . $arquivo;
                $nomeArquivo = basename($caminhoArquivo);

                if (strpos($nomeArquivo, 'avatar') !== false || strpos($nomeArquivo, 'config') !== false) {
                    try {
                        $resultadoDataModifyArquivo = shell_exec('adb shell stat -c "%y" ' . escapeshellarg($caminhoArquivo));
                        $resultadoDataChangeArquivo = shell_exec('adb shell stat -c "%z" ' . escapeshellarg($caminhoArquivo));

                        if ($resultadoDataModifyArquivo && $resultadoDataChangeArquivo) {
                            $dataModifyArquivo = new DateTime($resultadoDataModifyArquivo, new DateTimeZone('UTC'));
                            $dataModifyArquivo->setTimezone(new DateTimeZone('America/Sao_Paulo'));

                            $dataChangeArquivo = new DateTime($resultadoDataChangeArquivo, new DateTimeZone('UTC'));
                            $dataChangeArquivo->setTimezone(new DateTimeZone('America/Sao_Paulo'));

                            if ($dataModifyArquivo != $dataChangeArquivo) {
                                echo $bold . $vermelho . "  ✗ Modificação detectada no arquivo: $nomeArquivo! Aplique o W.O!\n\n";
                                $modificacaoDetectada = true;
                            }
                        }
                    } catch (Exception $e) {
                        echo $vermelho . "[!] Erro ao verificar datas do arquivo $nomeArquivo: " . $e->getMessage() . "\n";
                    }
                }
            }

            if (!$modificacaoDetectada) {
                echo $bold . $fverde . "  ℹ Nenhuma alteração suspeita encontrada nos arquivos.\n\n";
            }
        } else {
            echo $vermelho . "[*] Sem itens baixados! Verifique se a data é após o fim da partida!\n\n";
        }
    }

    echo $bold . $azul . "  → Checando OBB...\n";

    $diretorioObb = "/sdcard/Android/obb/" . $pacote;
    $comandoObb = 'adb shell "ls ' . escapeshellarg($diretorioObb) . '/*obb* 2>/dev/null"';
    $resultadoObb = shell_exec($comandoObb);

    if (!empty($resultadoObb)) {
        $arquivosObb = explode("\n", trim($resultadoObb));

        foreach ($arquivosObb as $arquivo) {
            if (empty($arquivo)) continue;
            $comandoDataChange = 'adb shell stat -c "%z" ' . escapeshellarg($arquivo) . ' 2>/dev/null';
            $resultadoDataChange = shell_exec($comandoDataChange);

            if (!empty($resultadoDataChange)) {
                $dataChange = new DateTime(trim($resultadoDataChange ?? ""), new DateTimeZone('UTC'));
                $dataChange->setTimezone(new DateTimeZone('America/Sao_Paulo'));

                echo $amarelo . "[*] Data de modificação do arquivo OBB: " . $dataChange->format("d-m-Y H:i:s") . "\n";
            } else {
                echo $vermelho . "[!] Não foi possível obter a data de modificação do arquivo OBB.\n";
            }
        }
    } else {
        echo $vermelho . "[*] OBB deletada e/ou inexistente!\n";
    }
    
    $diretorioShaders = "/sdcard/Android/data/" . $pacote . "/files/contentcache/Optional/android/gameassetbundles";
    $comandoShaders = 'adb shell "if [ -d ' . escapeshellarg($diretorioShaders) . ' ]; then find ' . escapeshellarg($diretorioShaders) . ' -type f; fi"';
    $resultadoShaders = shell_exec($comandoShaders);

    $encontrouBypass = false;
    $encontrouReplayPassado = false;
    $arquivoSuspeito = '';

    if (!empty($resultadoShaders)) {
        $arquivos = explode("\n", trim($resultadoShaders));
        $arquivos = array_filter($arquivos);
    
        foreach ($arquivos as $arquivo) {
            if (empty($arquivo)) continue;
    
            $comandoExiste = 'adb shell "if [ -f ' . escapeshellarg($arquivo) . ' ]; then echo 1; fi"';
            if (empty(shell_exec($comandoExiste))) {
                continue;
            }
    
            $nomeArquivo = basename($arquivo);
    
            $comandoVerificaUnityFS = 'adb shell "head -c 20 ' . escapeshellarg($arquivo) . ' 2>/dev/null"';
            $resultadoVerificaUnityFS = shell_exec($comandoVerificaUnityFS);
    
            if (!is_string($resultadoVerificaUnityFS) || strpos($resultadoVerificaUnityFS, "UnityFS") === false) {
                continue;
            }
    
            $comandoStat = 'adb shell "stat ' . escapeshellarg($arquivo) . ' 2>/dev/null"';
            $resultadoStat = shell_exec($comandoStat);
    
            if (!empty($resultadoStat) && strpos($resultadoStat, "No such file or directory") === false) {
                preg_match('/Modify: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $resultadoStat, $matchModify);
                preg_match('/Change: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $resultadoStat, $matchChange);
                preg_match('/Access: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $resultadoStat, $matchAccess);
    
                if (!empty($matchModify[1]) && !empty($matchChange[1]) && !empty($matchAccess[1])) {
                    $dataModifyOriginal = trim($matchModify[1]);
                    $dateTimeModify = DateTime::createFromFormat('Y-m-d H:i:s', $dataModifyOriginal);
                    $dataModify = $dateTimeModify ? $dateTimeModify->format('d-m-Y H:i:s') : "Formato inválido";
    
                    $currentDateTime = new DateTime("now");
                    $interval = $currentDateTime->diff($dateTimeModify);
                    $diffInSeconds = abs($interval->days * 24 * 60 * 60 + $interval->h * 3600 + $interval->i * 60 + $interval->s);
    
                    if ($diffInSeconds <= 3600) {
                        echo $bold . $amarelo . "  ⚠ Possível bypass detectado: arquivo shader alterado recentemente.\n";
                        echo $bold . $amarelo . "  ⚠ Arquivo: $nomeArquivo\n";
                        echo $bold . $amarelo . "  • Hora da modificação: $dataModify\n";
                        echo $bold . $amarelo . "  • Hora atual: " . $currentDateTime->format('d-m-Y H:i:s') . "\n\n";
                        $encontrouBypass = true;
                        $arquivoSuspeito = $nomeArquivo;
                        break;
                    }
    
                    $cmd = "adb shell dumpsys package " . escapeshellarg($pacote) . " | grep -i firstInstallTime";
                    $firstInstallTime = shell_exec($cmd);
    
                    if (!is_null($firstInstallTime) && preg_match('/firstInstallTime=([\d-]+ \d{2}:\d{2}:\d{2})/', $firstInstallTime, $matches)) {
                        $dataInstalacao = trim($matches[1]);
                        $dateTimeInstalacao = DateTime::createFromFormat('Y-m-d H:i:s', $dataInstalacao);
                        $dataInstalacaoFormatada = $dateTimeInstalacao ? $dateTimeInstalacao->format('d-m-Y H:i:s') : "Formato de data inválido.";
                    } else {
                        $dataInstalacaoFormatada = "Data de instalação não encontrada.";
                    }
    
                    if ($dataModify === $matchChange[1] && $dataModify === $matchAccess[1]) {
                        if (stripos($nomeArquivo, 'shader') !== false) {
                            if ($dataModify !== $dataInstalacao) {
                                echo $bold . $amarelo . "  ⚠ Arquivo shader modificado: " . $nomeArquivo . "\n";
                                echo $bold . $amarelo . "  ⚠ Horário da modificação: " . $dataModify . "\n"; 
                                echo $bold . $amarelo . "  • Data de instalação do Free Fire: " . $dataInstalacaoFormatada . "\n";
                                echo $bold . $branco . "  ▸ Por favor, verifique no App Usage a data de instalação do Free Fire e compare com o horário da modificação. Se for diferente, aplique o W.O!\n\n";
                                $encontrouReplayPassado = true;
                                $arquivoSuspeito = $nomeArquivo;
                            }
                            break;
                        }
                    }
                }
            }
        }
    
        if ($encontrouBypass) {
            echo $bold . $amarelo . "  ⚠ Modificação em arquivo de shaders detectada. Arquivo: " . $arquivoSuspeito . "\n";
            echo $bold . $amarelo . "  • Hora da modificação: " . $dataModify . "\n";
            echo $bold . $amarelo . "  • Verifique se a modificação ocorreu após a partida!\n\n";
        }
    } elseif ($encontrouReplayPassado) {
        echo $bold . $vermelho . "  ✗ Possível modificação em arquivo de shaders detectada. Arquivo: " . $arquivoSuspeito . ", Horário: " . $dataModify . "\n";
        echo $bold . $vermelho . "[*] Data de instalação do Free Fire: " . $dataInstalacaoFormatada . "\n";
        echo $bold . $branco . "  ▸ Verifique cuidadosamente no App Usage a data de instalação do Free Fire!\n\n";
    } else {
        echo $bold . $fverde . "  ℹ Nenhuma alteração suspeita encontrada.\n";
    }

    echo $bold . $branco . "  → Após verificar in-game se o usuário está de Wallhack, olhando skins de armas e atrás da parede, verifique os horários do Shaders e OBB e compare também com o horário do replay, caso esteja muito diferente as datas, aplique o W.O!\n\n";


    $diretorioAvatarRes = "/sdcard/Android/data/" . $pacote . "/files/contentcache/Optional/android/optionalavatarres/gameassetbundles";
    $diretorioOptionalAvatarRes = "/sdcard/Android/data/" . $pacote . "/files/contentcache/Optional/android/optionalavatarres";


    $comandoVerificarPasta = 'adb shell "test -d ' . escapeshellarg($diretorioAvatarRes) . ' && echo existe || echo naoexiste"';
    $resultadoVerificarPasta = trim((string)shell_exec($comandoVerificarPasta));

    $diretorioAlvo = "";
    $nomePasta = "";

    if ($resultadoVerificarPasta === "existe") {
        $diretorioAlvo = $diretorioAvatarRes;
        $nomePasta = "gameassetbundles";
    } else {
        $diretorioAlvo = $diretorioOptionalAvatarRes;
        $nomePasta = "optionalavatarres";
    }

    $comandoDataModify = 'adb shell stat -c "%y" ' . escapeshellarg($diretorioAlvo) . ' 2>/dev/null';
    $resultadoDataModify = trim((string)shell_exec($comandoDataModify));

    if ($resultadoDataModify !== '') {
        try {
            $dataModificacao = new DateTime($resultadoDataModify);
            $agora = new DateTime("now");

            echo $bold . $amarelo . "  • Data de modificação na pasta '$nomePasta' (Optional): " . $dataModificacao->format('d-m-Y H:i:s') . "\n";

            $intervalo = $agora->getTimestamp() - $dataModificacao->getTimestamp();

            if ($intervalo <= 3600) {
                echo $bold . $vermelho . "  ✗ Possível Bypass detectado em Optional! Modificada há menos de 1 hora.\n";
                echo $vermelho . "    Hora da modificação: " . $dataModificacao->format('H:i:s') . "\n";
                echo $vermelho . "    Hora atual:          " . $agora->format('H:i:s') . "\n";
            }

        } catch (Exception $e) {
            echo $vermelho . "[!] Erro ao extrair data de modificação da pasta '$nomePasta': " . $e->getMessage() . "\n";
        }
    }


    $comandoListarArquivos = 'adb shell "find ' . escapeshellarg($diretorioAvatarRes) . ' -type f 2>/dev/null"';
    $resultadoArquivos = (string)shell_exec($comandoListarArquivos);

    if ($resultadoArquivos !== '') {
        $arquivos = array_filter(explode("\n", trim($resultadoArquivos)), 'strlen');

        foreach ($arquivos as $arquivo) {
            $arquivo = (string)$arquivo;
            if ($arquivo === '') continue;
            
            $nomeArquivo = basename($arquivo);
            $caminhoArquivo = $arquivo;

            $comandoVerificaUnityFS = 'adb shell "head -c 20 ' . escapeshellarg($caminhoArquivo) . ' 2>/dev/null"';
            $resultadoVerificaUnityFS = (string)shell_exec($comandoVerificaUnityFS);

            if ($resultadoVerificaUnityFS === '' || strpos($resultadoVerificaUnityFS, "UnityFS") === false) {
                continue;
            }

            $comandoDataModifyArquivo = 'adb shell stat -c "%y" ' . escapeshellarg($caminhoArquivo) . ' 2>/dev/null';
            $comandoDataChangeArquivo = 'adb shell stat -c "%z" ' . escapeshellarg($caminhoArquivo) . ' 2>/dev/null';

            $resultadoDataModifyArquivo = trim((string)shell_exec($comandoDataModifyArquivo));
            $resultadoDataChangeArquivo = trim((string)shell_exec($comandoDataChangeArquivo));

            if ($resultadoDataModifyArquivo !== '' && $resultadoDataChangeArquivo !== '') {
                try {
                    $dataModifyArquivo = new DateTime($resultadoDataModifyArquivo, new DateTimeZone('UTC'));
                    $dataModifyArquivo->setTimezone(new DateTimeZone('America/Sao_Paulo'));

                    $dataChangeArquivo = new DateTime($resultadoDataChangeArquivo, new DateTimeZone('UTC'));
                    $dataChangeArquivo->setTimezone(new DateTimeZone('America/Sao_Paulo'));

                    if ($dataModifyArquivo != $dataChangeArquivo) {
                         echo $bold . $vermelho . "  ✗ Modificação detectada no arquivo Optional: $nomeArquivo! Aplique o W.O!\n";
                    }
                } catch (Exception $e) {}
            }
        }
    }

    echo $bold . $branco . "\n\n\t Obrigado por compactuar por um cenário limpo de cheats.\n";
    echo $bold . $branco . "\t                 Com carinho, Keller...\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";
}

function verificarDispositivoADB() {
    global $bold, $vermelho, $cln;


    $binaries = [
        '/data/data/com.termux/files/usr/bin/adb',
        '/data/data/com.termux/files/usr/bin/clear'
    ];
    foreach ($binaries as $bin) {
        if (file_exists($bin)) {
            @chmod($bin, 0755);
        }
    }

    $devicesOutput = shell_exec('adb devices');
    $devicesOutput = (string)$devicesOutput; 
    $lines = explode("\n", trim($devicesOutput));
    $devices = [];

    for ($i = 1; $i < count($lines); $i++) {
        $line = trim($lines[$i]);
        if (!empty($line) && strpos($line, 'device') !== false) {
            $parts = preg_split('/\s+/', $line);
            if (isset($parts[0])) {
                $devices[] = $parts[0];
            }
        }
    }

    $numDevices = count($devices);

    if ($numDevices == 0) {
        echo $bold . $vermelho . "[!] Erro: Nenhum dispositivo encontrado.\n";
        echo $bold . $vermelho . "    Faça o pareamento de IP ou conecte um dispositivo via USB.\n" . $cln;
        exit(1);
    } elseif ($numDevices > 1) {
        echo $bold . $vermelho . "[!] Erro: Mais de um dispositivo/emulador conectado.\n";
        echo $bold . $vermelho . "    Desconecte os outros dispositivos e mantenha apenas um.\n";
        echo $bold . $vermelho . "    Dispositivos encontrados:\n";
        foreach ($devices as $dev) {
            echo "    - $dev\n";
        }
        echo $cln;
        exit(1);
    }
    
    shell_exec('adb shell "chmod 755 /data/data/com.termux/files/usr/bin/clear 2>/dev/null"');

    return true;
}

function inputusuario($message){
  global $branco, $bold, $verdebg, $vermelhobg, $azulbg, $cln, $lazul, $fverde, $ciano;
  $inputstyle = $cln . $bold . $ciano . "  ▸ " . $message . ": " . $fverde ;
echo $inputstyle;
}


$binaries = [
    '/data/data/com.termux/files/usr/bin/adb',
    '/data/data/com.termux/files/usr/bin/clear'
];
foreach ($binaries as $bin) {
    if (file_exists($bin)) {
        @chmod($bin, 0755);
    }
}

system("clear");
keller_banner();
sleep(5);
echo "\n";

menuscanner:

    echo $bold . $azul . "
    ╔══════════════════════════════════════════════════════════════╗
    ║                      MENU PRINCIPAL                          ║
    ╚══════════════════════════════════════════════════════════════╝
      \n\n";
      echo $amarelo . "  [0] " . $branco . "Conectar ADB " . $cinza . "(Pareamento e conexão via ADB)\n" . $cln;
      echo $verde . "  [1] " . $branco . "Escanear FreeFire Normal\n" . $cln;
      echo $verde . "  [2] " . $branco . "Escanear FreeFire Max\n" . $cln;
      echo $vermelho . "  [S] " . $branco . "Sair\n\n" . $cln;
escolheropcoes:
    inputusuario("Escolha uma das opções acima");
    $opcaoscanner = trim(fgets(STDIN, 1024));


    if (!in_array($opcaoscanner, array(
      '0',
      '1',
      '2',	
      'S',
  ), true))
    {
      echo $bold . $vermelho . "\n[!] Opção inválida! Tente novamente. \n\n" . $cln;
      goto escolheropcoes;
    }
    else
    {
        if ($opcaoscanner == "0") {
            system("clear");
            keller_banner();
            
            echo $bold . $azul . "  → Verificando se o ADB está instalado...\n" . $cln;
            if (!shell_exec("adb version > /dev/null 2>&1"))
            {
                echo $bold . $amarelo . "  ⚠ ADB não encontrado. Instalando android-tools...\n" . $cln;
                system("pkg install android-tools -y");
                echo $bold . $fverde . "  ℹ Android-tools instalado com sucesso!\n\n" . $cln;
            } else {
                echo $bold . $fverde . "  ℹ ADB já está instalado.\n\n" . $cln;
            }
            
            inputusuario("Qual a sua porta para o pareamento (ex: 45678)?");
            $pair_port = trim(fgets(STDIN, 1024));
            if (!empty($pair_port) && is_numeric($pair_port)) {
                echo $bold . $amarelo . "\n[!] Agora, digite o código de pareamento que aparece no seu celular e pressione Enter.\n" . $cln;
                system("adb pair localhost:" . $pair_port);
            } else {
                echo $bold . $vermelho . "\n[!] Porta inválida! Retornando ao menu.\n\n" . $cln;
                sleep(2);
                system("clear");
                keller_banner();
                goto menuscanner;
            }
            
            echo "\n";
            
            inputusuario("Qual a sua porta para a conexão (ex: 12345)?");
            $connect_port = trim(fgets(STDIN, 1024));
            if (!empty($connect_port) && is_numeric($connect_port)) {
                echo $bold . $amarelo . "\n[!] Conectando ao dispositivo...\n" . $cln;
                system("adb connect localhost:" . $connect_port);
                echo $bold . $fverde . "\n[i] Processo de conexão finalizado. Verifique a saída acima para ver se a conexão foi bem-sucedida.\n" . $cln;
                echo $bold . $branco . "\n[+] Pressione Enter para voltar ao menu...\n" . $cln;
                fgets(STDIN, 1024);
                system("clear");
                keller_banner();
                goto menuscanner;
            } else {
                echo $bold . $vermelho . "\n[!] Porta inválida! Retornando ao menu.\n\n" . $cln;
                sleep(2);
                system("clear");
                keller_banner();
                goto menuscanner;
            }
        } elseif ($opcaoscanner == "1") {
            escanearFreeFire("com.dts.freefireth", "FreeFire Normal");
        } elseif ($opcaoscanner == "2") {
            escanearFreeFire("com.dts.freefiremax", "FreeFire MAX");
        } elseif ($opcaoscanner == 's' || $opcaoscanner == 'S') {
            echo "\n\n\t Obrigado por compactuar por um cenário limpo de cheats.\n\n";
            die();
        }
      }

?>