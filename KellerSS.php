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
  echo "\e[37m
           KellerSS Android\e[36m Fucking Cheaters\e[91m\e[37m discord.gg/allianceoficial\e[91m
            
                            )       (     (          (     
                        ( /(       )\ )  )\ )       )\ )  
                        )\()) (   (()/( (()/(  (   (()/(  
                        |((_)\  )\   /(_)) /(_)) )\   /(_)) 
                        |_ ((_)((_) (_))  (_))  ((_) (_))   
                        | |/ / | __|| |   | |   | __|| _ \  
                        ' <  | _| | |__ | |__ | _| |   /  
                        _|\_\ |___||____||____||___||_|_\  



                    \e[36m{C} Coded By - KellerSS | Credits for Sheik                                   
\e[32m
  \n";
}


echo $cln;

function atualizar()
{
    global $cln, $bold, $fverde;
    echo "\n\e[91m\e[1m[+] KellerSS Updater [+]\nAtualizando, por favor aguarde...\n\n$cln";
    system("git fetch origin && git reset --hard origin/master && git clean -f -d");
    echo $bold . $fverde . "[i] Atualização concluida! Por favor reinicie o Scanner \n" . $cln;
    exit;
}

function inputusuario($message){
  global $branco, $bold, $verdebg, $vermelhobg, $azulbg, $cln, $lazul, $fverde;
  $amarelobg = "\e[100m";
  $inputstyle = $cln . $bold . $lazul . "[#] " . $message . ": " . $fverde ;
echo $inputstyle;
}

system("clear");
keller_banner();
sleep(5);
echo "\n";

menuscanner:

    echo $bold . $azul . "
      +--------------------------------------------------------------+
      +                       KellerSS Menu                          +
      +--------------------------------------------------------------+

      \n\n";
      echo $amarelo . " [0]  Conectar ADB$branco (Pareamento e conexão via ADB)$fverde \n [1]  Escanear FreeFire Normal \n$fverde [2]  Escanear FreeFire Max \n {$vermelho}[S]  Sair \n\n" . $cln;
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
            
            // Verificar e instalar android-tools se necessário
            echo $bold . $azul . "[+] Verificando se o ADB está instalado...\n" . $cln;
            if (!shell_exec("adb version > /dev/null 2>&1"))
            {
                echo $bold . $amarelo . "[!] ADB não encontrado. Instalando android-tools...\n" . $cln;
                system("pkg install android-tools -y");
                echo $bold . $fverde . "[i] Android-tools instalado com sucesso!\n\n" . $cln;
            } else {
                echo $bold . $fverde . "[i] ADB já está instalado.\n\n" . $cln;
            }
            
            // Pareamento ADB
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
            
            // Conexão ADB
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
            system("clear");
            keller_banner();

            if (!shell_exec("adb version > /dev/null 2>&1"))
            {
                system("pkg install -y android-tools > /dev/null 2>&1");
            }


            date_default_timezone_set('America/Sao_Paulo');
            shell_exec('adb start-server > /dev/null 2>&1');

    

            $comandoDispositivos = shell_exec("adb devices 2>&1");

                if (empty($comandoDispositivos) || strpos($comandoDispositivos, "device") === false || strpos($comandoDispositivos, "no devices") !== false) {
                    echo "\033[1;31m[!] Nenhum dispositivo encontrado. Faça o pareamento de IP ou conecte um dispositivo via USB.\n\n";
                    exit;
                }

                $comandoVerificarFF = shell_exec("adb shell pm list packages --user 0 | grep com.dts.freefireth 2>&1");


                if (!empty($comandoVerificarFF) && strpos($comandoVerificarFF, "more than one device/emulator") !== false) {
                    echo $bold . $vermelho . "[!] Pareamento realizado de maneira incorreta, digite \"adb disconnect\" e refaça o processo.\n\n";
                    exit;
                }
                
                if (!empty($comandoVerificarFF) && strpos($comandoVerificarFF, "com.dts.freefireth") !== false) {
                } else {
                    echo $bold . $vermelho . "[!] O FreeFire está desinstalado, cancelando a telagem...\n\n";
                    exit;
                }


                $comandoVersaoAndroid = "adb shell getprop ro.build.version.release";
                $resultadoVersaoAndroid = shell_exec($comandoVersaoAndroid);

                if (!empty($resultadoVersaoAndroid)) {
                    echo $bold . $azul . "[+] Versão do Android: " . trim($resultadoVersaoAndroid) . "\n";
                } else {
                    echo $bold . $vermelho . "[!] Não foi possível obter a versão do Android.\n";
                }


                $comandoSu = 'su 2>&1';
                $resultadoSu = shell_exec($comandoSu);

                echo $bold . $azul . "[+] Checando se possui Root (se o programa travar, root detectado)...\n";
                if (!empty($resultadoSu) && strpos($resultadoSu, 'No su program found') !== false) {
                    echo $bold . $fverde . "[-] O dispositivo não tem root.\n\n";
                } else {
                    echo $bold . $vermelho . "[+] Root detectado no dispositivo Android.\n\n";
                }
                


            echo $bold . $azul . "[+] Checando se o dispositivo foi reiniciado recentemente...\n";
            $comandoUPTIME = shell_exec("adb shell uptime");

            if (preg_match('/up (\d+) min/', $comandoUPTIME, $filtros)) {
                $minutos = $filtros[1];
                echo $bold . $vermelho . "[!] O dispositivo foi iniciado recentemente (há $minutos minutos).\n\n";
            } else {
                echo $bold . $fverde . "[i] Dispositivo não reiniciado recentemente.\n\n";
            }


            $logcatTime = shell_exec("adb logcat -d -v time | head -n 2");
                preg_match('/(\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $logcatTime, $matchTime);

                if (!empty($matchTime[1])) {

                    $date = DateTime::createFromFormat('m-d H:i:s', $matchTime[1]);
                    $formattedDate = $date->format('d-m H:i:s'); 

                    echo $bold . $amarelo . "[+] Primeira log do sistema: " . $formattedDate . "\n";
                    echo $bold . $branco . "[+] Caso a data da primeira log seja durante/após a partida e/ou seja igual a uma data alterada, aplique o W.O!\n\n";

                } else {
                    echo $bold . $vermelho . "[!] Não foi possível capturar a data/hora do sistema.\n\n";
                }
            
            echo $bold . $azul . "[+] Verificando mudanças de data/hora...\n";

                
            $logcatOutput = shell_exec('adb logcat -d | grep "UsageStatsService: Time changed" | grep -v "HCALL"');

            if ($logcatOutput !== null && trim($logcatOutput) !== "") {
                $logLines = explode("\n", trim($logcatOutput));
            } else {
                echo $bold . $vermelho . "[!] Erro ao obter logs de modificação de data/hora, verifique a data da primeira log do sistema.\n\n";
            }


            $fusoHorario = trim(shell_exec('adb shell getprop persist.sys.timezone'));

            if ($fusoHorario !== "America/Sao_Paulo") {
                echo $bold . $amarelo . "[!] Aviso: O fuso horário do dispositivo é '$fusoHorario', diferente de 'America/Sao_Paulo', possivel tentativa de Bypass.\n\n";
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
                    echo $bold . $amarelo . "[!] Alterou horário de {$log['dataAntiga']} para {$log['dataNova']} {$log['horaNovaFormatada']} ({$log['acao']} horário)\n";
                }
            } else {
                echo $bold . $vermelho . "[!] Nenhum log de alteração de horário encontrado.\n\n";
            }

        
            
            echo $bold . $azul . "\n[+] Checando se modificou data e hora...\n";
            $autoTime = trim(shell_exec('adb shell settings get global auto_time'));
            $autoTimeZone = trim(shell_exec('adb shell settings get global auto_time_zone'));

            if ($autoTime !== "1" || $autoTimeZone !== "1") {
                echo $bold . $vermelho . "[!] Possível bypass detectado: data e hora/furo horário automático desativado.\n";
            } else {
                echo $bold . $fverde . "[i] Data e hora/fuso horário automático estão ativados.\n";
            }

            echo $bold . $branco . "[+] Caso haja mudança de horário durante/após a partida, aplique o W.O!\n\n";


            echo $bold . $azul . "[+] Obtendo os últimos acessos do Google Play Store...\n";

            $comandoUSAGE = shell_exec("adb shell dumpsys usagestats 2>/dev/null | grep -i 'MOVE_TO_FOREGROUND' 2>/dev/null | grep 'package=com.android.vending' 2>/dev/null | awk -F'time=\"' '{print \$2}' 2>/dev/null | awk '{gsub(/\"/, \"\"); print \$1, \$2}' 2>/dev/null | tail -n 5 2>/dev/null");

            if (!is_null($comandoUSAGE) && trim($comandoUSAGE) !== "") {
                echo $bold . $fverde . "[i] Últimos 5 acessos:\n";
                echo $amarelo . $comandoUSAGE . "\n";
            } else {
                echo $bold . "\e[31m[!] Nenhum dado encontrado.\n";
            }
            echo $bold . $branco . "[+] Caso haja acesso durante/após a partida, aplique o W.O!\n\n";

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

                        echo $bold . $amarelo . "[!] " . $data . " " . $hora . " " . $branco . "$conteudo" . "\n";
                    }
                }
            } else {
                echo $bold . "\e[31m[!] Nenhum dado encontrado.\n";
            }

            echo "\n";



            echo $bold . $azul . "[+] Checando se o replay foi passado...\n";

                $comandoArquivos = 'adb shell "ls -t /sdcard/Android/data/com.dts.freefireth/files/MReplays/*.bin 2>/dev/null"';
                $output = shell_exec($comandoArquivos) ?? '';
                $arquivos = array_filter(explode("\n", trim($output)));
                
                $motivos = [];
                $arquivoMaisRecente = null;
                $ultimoModifyTime = null;
                $ultimoChangeTime = null;
                
                // Motivo 10 - Nenhum replay encontrado
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
                
                        $accessTime = strtotime($dataAccess);
                        $modifyTime = strtotime($dataModify);
                        $changeTime = strtotime($dataChange);
                
                        if ($indice === 0) {
                            $ultimoModifyTime = $modifyTime;
                            $ultimoChangeTime = $changeTime;
                        }
                
                        // Motivo 1 - Access posterior ao Modify
                        if ($accessTime > $modifyTime) {
                            $motivos[] = "Motivo 1 - Access posterior ao Modify " . basename($arquivo);
                        }
                
                        // Motivo 2 - Timestamps com .000
                        if (
                            preg_match('/\.0+$/', $dataAccess) ||
                            preg_match('/\.0+$/', $dataModify) ||
                            preg_match('/\.0+$/', $dataChange)
                        ) {
                            $motivos[] = "Motivo 2 - Timestamps com .000 " . basename($arquivo);
                        }
                
                        // Motivo 3 - Modify diferente de Change no arquivo
                        if ($dataModify !== $dataChange) {
                            $motivos[] = "Motivo 3 - Modify diferente de Change no arquivo " . basename($arquivo);
                        }
                
                        // Motivo 4 - Nome do arquivo não bate com Modify
                        if ($indice === 0) {
                            $arquivoMaisRecente = $arquivo;
                        
                            if (preg_match('/(\d{4}-\d{2}-\d{2}-\d{2}-\d{2}-\d{2})/', basename($arquivo), $match)) {
                                $nomeNormalizado = preg_replace(
                                    '/^(\d{4})-(\d{2})-(\d{2})-(\d{2})-(\d{2})-(\d{2})$/',
                                    '$1-$2-$3 $4:$5:$6',
                                    $match[1]
                                );
                                $nomeTimestamp = strtotime($nomeNormalizado);
                        
                                preg_match('/(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\.(\d+)/', $dataModify, $modifyParts);
                                $dataModifyBase = $modifyParts[1] ?? '';
                                $nanosModify = (int)($modifyParts[2] ?? 0);
                                $modifyTimestamp = strtotime($dataModifyBase);
                        
                                if ($nomeTimestamp !== false && $modifyTimestamp !== false) {
  
                                    $nomeNsTotal = $nomeTimestamp * 1_000_000_000;
                                    $modifyNsTotal = ($modifyTimestamp * 1_000_000_000) + $nanosModify;
                        
                                    $diffNs = abs($modifyNsTotal - $nomeNsTotal);
                        
                                    if ($diffNs > 1_000_000_000) { 
                                        $motivos[] = "Motivo 4 - Nome do arquivo não bate com Modify: " . basename($arquivo);
                                    }
                                } else {
                                    $motivos[] = "Motivo 4 - erro ao converter timestamps (Modify: $dataModify, Nome: {$match[1]})";
                                }
                            }
                        }
                        
                        
                
                        // Motivo 8 - Access do .json diferente dos tempos do .bin
                        $jsonPath = preg_replace('/\.bin$/', '.json', $arquivo);
                        $jsonStat = shell_exec('adb shell "stat ' . escapeshellarg($jsonPath) . ' 2>/dev/null"');
                        if ($jsonStat && preg_match('/Access: (.*?)\n/', $jsonStat, $matchJsonAccess)) {
                            $jsonAccess = trim(preg_replace('/ -\d{4}$/', '', $matchJsonAccess[1]));
                            $dataBinTimes = [$dataAccess, $dataModify, $dataChange];
                            if (!in_array($jsonAccess, $dataBinTimes)) {
                                $motivos[] = "Motivo 8 - Access do .json diferente dos tempos do .bin" . basename($jsonPath);
                            }
                        }
                        if (!$jsonStat) {
                            $motivos[] = "Motivo 8 - Arquivo JSON ausente: " . basename($jsonPath);
                        }

                    }
                }
                
                // Verificações na pasta MReplays
                $resultadoPasta = shell_exec('adb shell "stat /sdcard/Android/data/com.dts.freefireth/files/MReplays 2>/dev/null"');
                if ($resultadoPasta) {
                    preg_match_all('/^(Access|Modify|Change):\s(\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}\.\d+)(?:\s[+-]\d{4})?/m', $resultadoPasta, $matches, PREG_SET_ORDER);
                    $timestamps = [];
                    foreach ($matches as $match) {
                        $timestamps[$match[1]] = trim($match[2]);
                    }
                
                    if (count($timestamps) === 3) {
                        $pastaModifyTime = strtotime($timestamps['Modify']);
                        $pastaChangeTime = strtotime($timestamps['Change']);
                
                        // Motivo 7 - Pasta modificada após o último replay
                        if ($ultimoModifyTime && $pastaModifyTime > $ultimoModifyTime) {
                            $motivos[] = "Motivo 7 - Pasta modificada após o último replay";
                        }
                        if ($ultimoChangeTime && $pastaChangeTime > $ultimoChangeTime) {
                            $motivos[] = "Motivo 7 - Pasta modificada após o último replay";
                        }
                
                        // Motivo 5 - Access, Modify e Change idênticos
                        if ($timestamps['Access'] === $timestamps['Modify'] && $timestamps['Modify'] === $timestamps['Change']) {
                            $motivos[] = "Motivo 5 - Access, Modify e Change idênticos";
                        }
                
                        // Motivo 6 - Milissegundos .000 na pasta
                        if (preg_match('/\.0+$/', $timestamps['Modify']) || preg_match('/\.0+$/', $timestamps['Change'])) {
                            $motivos[] = "Motivo 6 - Milissegundos .000 na pasta";
                        }
                
                        // Motivo 11 - Modify diferente de Change na pasta
                        if ($timestamps['Modify'] !== $timestamps['Change']) {
                            $motivos[] = "Motivo 11 - Modify diferente de Change na pasta";
                        }

                        // Motivo 12 - Change da pasta MReplays diferente dos Access dos arquivos
                        if (
                            $arquivoMaisRecente &&
                            isset($timestamps['Change'])
                        ) {
                            $changeMReplays = trim($timestamps['Change']);
                        
                            // 1) Stat do .bin
                            $statBin = shell_exec('adb shell "stat ' . escapeshellarg($arquivoMaisRecente) . ' 2>/dev/null"');
                            preg_match_all('/Access: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d+)(?: [-+]\d{4})?/', $statBin, $matchesBin);
                            $binAccess = isset($matchesBin[1]) ? end($matchesBin[1]) : '';
                        
                            // 2) Stat do .json
                            $jsonPath = preg_replace('/\.bin$/', '.json', $arquivoMaisRecente);
                            $statJson = shell_exec('adb shell "stat ' . escapeshellarg($jsonPath) . ' 2>/dev/null"');
                            preg_match_all('/Access: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d+)(?: [-+]\d{4})?/', $statJson, $matchesJson);
                            $jsonAccess = isset($matchesJson[1]) ? end($matchesJson[1]) : '';
                        
                            if ($binAccess !== $changeMReplays && $jsonAccess !== $changeMReplays) {
                                $motivos[] = "Motivo 12 - Change da pasta MReplays não bate com Access do .bin ou .json\n" .
                                            "Change MReplays: $changeMReplays\n" .
                                            "Access .bin:     $binAccess\n" .
                                            "Access .json:    $jsonAccess";
                            }
                        }
                        






                
                        // Motivo 9 - Nome não bate com Modify da pasta + milissegundos suspeitos
                        if ($arquivoMaisRecente && isset($timestamps['Access'])) {
                            if (preg_match('/(\d{4}-\d{2}-\d{2}-\d{2}-\d{2}-\d{2})/', basename($arquivoMaisRecente), $match)) {
                                $nomeNormalizado = str_replace('-', '', $match[1]);
                                $modifyPastaNormalizado = str_replace(['-', ' ', ':'], '', $timestamps['Modify']);
                                if (preg_match('/\.(\d{2})(\d+)/', $timestamps['Access'], $milisegundosMatch)) {
                                    $doisPrimeiros = (int)$milisegundosMatch[1];
                                    $restante = $milisegundosMatch[2];
                                    $todosZeros = preg_match('/^0+$/', $milisegundosMatch[0]);
                                    $condicaoValida = ($doisPrimeiros <= 90 && preg_match('/^0+$/', $restante));
                                    if (($todosZeros || $condicaoValida) && $nomeNormalizado !== $modifyPastaNormalizado) {
                                        $motivos[] = "Motivo 9 - Nome não bate com Modify da pasta + milissegundos suspeitos" . basename($arquivoMaisRecente);
                                    }
                                }
                            }
                        }
                    }
                }
                


                $comandoLs = 'adb shell "ls -l /sdcard/Android/data/com.dts.freefireth/files/MReplays/*.bin 2>/dev/null"';
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
                    echo $bold . $vermelho . "[!] Passador de replay detectado, aplique o W.O!\n";
                    foreach (array_unique($motivos) as $motivo) {
                        echo "    - " . $motivo . "\n";
                    }
                } else {
                    echo $bold . $fverde . "[i] Nenhum replay foi passado e a pasta MReplays está normal.\n";
                }




                if (!empty($resultadoPasta)) {
                    preg_match('/Access: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d+)/', $resultadoPasta, $matchAccessPasta);
                    
                    if (!empty($matchAccessPasta[1])) {
                        $dataAccessPasta = trim($matchAccessPasta[1]);
                        $dataAccessPastaSemMilesimos = preg_replace('/\.\d+.*$/', '', $dataAccessPasta);
                        
                        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dataAccessPastaSemMilesimos);
                        $dataFormatada = $dateTime ? $dateTime->format('d-m-Y H:i:s') : $dataAccessPastaSemMilesimos;

                        $cmd = "adb shell dumpsys package com.dts.freefireth | grep -i firstInstallTime";
                        $firstInstallTime = shell_exec($cmd);

                        if (preg_match('/firstInstallTime=([\d-]+ \d{2}:\d{2}:\d{2})/', $firstInstallTime, $matches)) {
                            $dataInstalacao = trim($matches[1]);
                            $dateTimeInstalacao = DateTime::createFromFormat('Y-m-d H:i:s', $dataInstalacao);
                            $dataInstalacaoFormatada = $dateTimeInstalacao ? $dateTimeInstalacao->format('d-m-Y H:i:s') : "Formato inválido";
                        } else {
                            $dataInstalacaoFormatada = "Não encontrada";
                        }

                        echo $bold . $amarelo . "[+] Data de acesso da pasta MReplays: $dataFormatada\n";
                        echo $bold . $amarelo . "[*] Data de instalação do Free Fire: $dataInstalacaoFormatada\n";
                        echo $bold . $branco . "[#] Verifique a data de instalação do jogo com a data de acesso da pasta MReplays para ver se o jogo foi recém instalado antes da partida, se não, vá no histórico e veja se o player jogou outras partidas recentemente, se sim, aplique o W.O!\n\n";
                    } else {
                        echo $bold . $vermelho . "[!] Não foi possível obter a data de acesso da pasta MReplays\n\n";
                    }
                }





                                                    



                echo $bold . $azul . "[+] Checando bypass de Wallhack/Holograma...\n";

                $pastasParaVerificar = [
                    "/sdcard/Android/data/com.dts.freefireth/files/contentcache/Optional/android/gameassetbundles",
                    "/sdcard/Android/data/com.dts.freefireth/files/contentcache/Optional/android",
                    "/sdcard/Android/data/com.dts.freefireth/files/contentcache/Optional",
                    "/sdcard/Android/data/com.dts.freefireth/files/contentcache",
                    "/sdcard/Android/data/com.dts.freefireth/files",
                    "/sdcard/Android/data/com.dts.freefireth",
                    "/sdcard/Android/data",
                    "/sdcard/Android"
                ];


                $pastasParaVerificar2 = [
                    "/sdcard/Android/data/com.dts.freefireth/files/contentcache/Optional/android/gameassetbundles",
                    "/sdcard/Android/data/com.dts.freefireth/files/contentcache/Optional/android",
                    "/sdcard/Android/data/com.dts.freefireth/files/contentcache/Optional",
                    "/sdcard/Android/data/com.dts.freefireth/files/contentcache",
                    "/sdcard/Android/data/com.dts.freefireth/files",
                    "/sdcard/Android/data/com.dts.freefireth"
                ];

                

                foreach ($pastasParaVerificar as $pasta) {
                    $comandoStat = 'adb shell stat ' . escapeshellarg($pasta) . ' 2>&1';
                    $resultadoStat = shell_exec($comandoStat);
                
                    if (strpos($resultadoStat, 'File:') !== false) {
                        preg_match('/Modify: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d+)/', $resultadoStat, $matchModify);
                        preg_match('/Change: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d+)/', $resultadoStat, $matchChange);
                
                        if ($matchModify && $matchChange) {
                            $dataModify = trim($matchModify[1]);
                            $dataChange = trim($matchChange[1]);
                
                            $dataModifyFormatada = preg_replace('/\.\d+.*$/', '', $dataModify);
                            $dataChangeFormatada = preg_replace('/\.\d+.*$/', '', $dataChange);
                
                            if ($dataModifyFormatada !== $dataChangeFormatada) {
                                $nomefinalpasta = basename($pasta);
                                
                                $dateTimeChange = DateTime::createFromFormat('Y-m-d H:i:s', $dataChangeFormatada);
                                $dataChangeFormatadaLegivel = $dateTimeChange ? $dateTimeChange->format('d-m-Y H:i:s') : $dataChangeFormatada;
                                
                                echo $bold . $vermelho . "[!] Bypass de renomear/substituir na pasta: $nomefinalpasta! Confira se o horário é após a partida, se sim, aplique o W.O!\n";
                                echo $bold . $amarelo . "[i] Horário do renomeio/substituição: $dataChangeFormatadaLegivel\n\n";
                            }
                        }
                    }
                }

                $comandoFindBin = 'adb shell ls -t "/sdcard/Android/data/com.dts.freefireth/files/MReplays" | grep "\.bin$" | head -n 1';
                $arquivoBinMaisRecente = shell_exec($comandoFindBin);

                if ($arquivoBinMaisRecente !== null && $arquivoBinMaisRecente !== '') {
                    $arquivoBinMaisRecente = trim($arquivoBinMaisRecente);
                    $caminhoCompletoBin = "/sdcard/Android/data/com.dts.freefireth/files/MReplays/$arquivoBinMaisRecente";
                    $comandoStatBin = 'adb shell stat ' . escapeshellarg($caminhoCompletoBin) . ' 2>&1';
                    $resultadoStatBin = shell_exec($comandoStatBin);
                    preg_match('/Access: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $resultadoStatBin, $matchAccessBin);

                    if ($matchAccessBin) {
                        $dataAccessBin = $matchAccessBin[1];
                        $timestampAccessBinOriginal = strtotime($dataAccessBin);
                        $timestampAccessBinComMargem = $timestampAccessBinOriginal - (10 * 60); // -10 minutos

                        $pastasParaVerificar = [
                            "/sdcard/Android/data/com.dts.freefireth/files/contentcache",
                            "/sdcard/Android/data/com.dts.freefireth/files/contentcache/Optional/android"
                        ];

                        $bypassDetectado = false;
                        foreach ($pastasParaVerificar as $pasta) {
                            $comandoStat = 'adb shell stat ' . escapeshellarg($pasta) . ' 2>&1';
                            $resultadoStat = shell_exec($comandoStat);

                            preg_match('/Access: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $resultadoStat, $matchAccess);
                            preg_match('/Modify: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $resultadoStat, $matchModify);
                            preg_match('/Change: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $resultadoStat, $matchChange);

                            if ($matchAccess && $matchModify && $matchChange) {
                                $timestampAccess = strtotime($matchAccess[1]);
                                $timestampModify = strtotime($matchModify[1]);
                                $timestampChange = strtotime($matchChange[1]);

                                if (
                                    $timestampAccess > $timestampAccessBinComMargem ||
                                    $timestampModify > $timestampAccessBinComMargem ||
                                    $timestampChange > $timestampAccessBinComMargem
                                ) {
                                    $bypassDetectado = true;
                                    break;
                                }
                            }
                        }

                        if ($bypassDetectado) {
                            echo $bold . $vermelho . "[!] Modificando pastas após o fim da partida, aplique o W.O!\n\n";
                        } else {
                            echo $bold . $verde . "[+] Nenhum bypass de holograma detectado.\n\n";
                        }
                    } else {
                        echo $bold . $amarelo . "[!] Não foi possível obter a data do último .bin.\n";
                    }
                } else {
                    echo $bold . $vermelho . "[!] Nenhum .bin encontrado em MReplays.\n";
                }


                $cmd = "adb shell dumpsys package com.dts.freefireth | grep -i firstInstallTime";
                $firstInstallTime = shell_exec($cmd);

                $firstInstallDate = null;
                if (preg_match('/firstInstallTime=(\d{4}-\d{2}-\d{2})/', $firstInstallTime, $matchInstall)) {
                    $firstInstallDate = $matchInstall[1];
                }

                $cmdUpdate = "adb shell dumpsys package com.dts.freefireth | grep -i lastUpdateTime";
                $lastUpdateTime = shell_exec($cmdUpdate);

                $lastUpdateDate = null;
                if (preg_match('/lastUpdateTime=(\d{4}-\d{2}-\d{2})/', $lastUpdateTime, $matchUpdate)) {
                    $lastUpdateDate = $matchUpdate[1];
                }

                $pastaShaders = "/sdcard/Android/data/com.dts.freefireth/files/contentcache/Optional/android/gameassetbundles";

                $comandoFind = 'adb shell find ' . escapeshellarg($pastaShaders) . ' -name "shaders*" -type f 2>&1';
                $arquivosShaders = shell_exec($comandoFind);
                
                if (!empty($arquivosShaders)) {
                    $arquivosShaders = explode("\n", trim($arquivosShaders));
                
                    foreach ($arquivosShaders as $arquivo) {
                        if (empty($arquivo)) continue;
                
                        $comandoStat = 'adb shell stat ' . escapeshellarg($arquivo) . ' 2>&1';
                        $resultadoStat = shell_exec($comandoStat);
                
                        if (strpos($resultadoStat, 'File:') !== false) {
                            preg_match('/Access: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $resultadoStat, $matchAccess);
                            preg_match('/Modify: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $resultadoStat, $matchModify);
                            preg_match('/Change: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $resultadoStat, $matchChange);
                
                            if ($matchAccess && $matchModify && $matchChange) {
                                $accessDate = $matchAccess[1];
                                $modifyDate = $matchModify[1];
                                $changeDate = $matchChange[1];
                
                                $nomeArquivo = basename($arquivo);
                
                                if ($accessDate === $modifyDate && $modifyDate === $changeDate) {
                                    $timestampArquivo = strtotime($accessDate);
                                    $ignorarAviso = false;
                                    
                                    if ($firstInstallDate) {
                                        $timestampInstalacao = strtotime($firstInstallDate);
                                        $diferencaSegundosInstall = abs($timestampArquivo - $timestampInstalacao);
                                        
                                        if ($diferencaSegundosInstall <= 86400) {
                                            $ignorarAviso = true;
                                        }
                                    }

                                    if (!$ignorarAviso && $lastUpdateDate) {
                                        $timestampAtualizacao = strtotime($lastUpdateDate);
                                        $diferencaSegundosUpdate = abs($timestampArquivo - $timestampAtualizacao);
                                        
                                        if ($diferencaSegundosUpdate <= 86400) {
                                            $ignorarAviso = true;
                                        }
                                    }
                                    
                                    if ($ignorarAviso) {
                                        continue;
                                    }
                                
                                    echo $bold . $laranja . "[!] Possível Bypass Holograma detectado (ACCESS, MODIFY, CHANGE iguais)\n";
                                    echo $bold . $laranja . "[!] Arquivo: $nomeArquivo\n";
                
                                    $dateTimeAccess = DateTime::createFromFormat('Y-m-d H:i:s', $accessDate);
                                    $dataAccessFormatada = $dateTimeAccess ? $dateTimeAccess->format('d-m-Y H:i:s') : $accessDate;
                
                                    $dateTimeInstall = DateTime::createFromFormat('Y-m-d H:i:s', $firstInstallDate);
                                    $dataInstallFormatada = $dateTimeInstall ? $dateTimeInstall->format('d-m-Y H:i:s') : $firstInstallDate;
                
                                    echo $bold . $laranja . "[!] Data da modificação (Access/Modify/Change): $dataAccessFormatada\n";
                                    echo $bold . $laranja . "[!] Data de instalação do FF: $dataInstallFormatada\n";
                                    
                                    if ($lastUpdateDate) {
                                        $dateTimeUpdate = DateTime::createFromFormat('Y-m-d H:i:s', $lastUpdateDate);
                                        $dataUpdateFormatada = $dateTimeUpdate ? $dateTimeUpdate->format('d-m-Y H:i:s') : $lastUpdateDate;
                                        echo $bold . $laranja . "[!] Data de atualização do FF: $dataUpdateFormatada\n";
                                    }
                                    
                                    echo $bold . $laranja . "[!] Se for após a partida, aplique o W.O!\n\n";
                                    continue;
                                }
                
                                if ($modifyDate !== $changeDate) {
                                    $dateTimeChange = DateTime::createFromFormat('Y-m-d H:i:s', $changeDate);
                                    $dataChangeFormatadaLegivel = $dateTimeChange ? $dateTimeChange->format('d-m-Y H:i:s') : $changeDate;
                
                                    echo $bold . $vermelho . "[!] Arquivo shader modificado: $nomeArquivo\n";
                                    echo $bold . $amarelo . "[i] Horário da modificação: $dataChangeFormatadaLegivel\n";
                                    echo $bold . $vermelho . "[!] Verifique se a data é após a partida, se sim aplique o W.O!\n\n";
                                }
                            }
                        }
                    }
                } else {
                    echo $bold . $amarelo . "[i] Nenhum arquivo de shader encontrado.\n";
                }



                $diretorioShaders = "/sdcard/Android/data/com.dts.freefireth/files/contentcache/Optional/android/gameassetbundles";
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
                                    echo $bold . $amarelo . "[!] Possível bypass detectado: arquivo shader alterado recentemente.\n";
                                    echo $bold . $amarelo . "[!] Arquivo: $nomeArquivo\n";
                                    echo $bold . $amarelo . "[*] Hora da modificação: $dataModify\n";
                                    echo $bold . $amarelo . "[*] Hora atual: " . $currentDateTime->format('d-m-Y H:i:s') . "\n\n";
                                    $encontrouBypass = true;
                                    $arquivoSuspeito = $nomeArquivo;
                                    break;
                                }
                
                                $cmd = "adb shell dumpsys package com.dts.freefireth | grep -i firstInstallTime";
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
                                            echo $bold . $amarelo . "[!] Arquivo shader modificado: " . $nomeArquivo . "\n";
                                            echo $bold . $amarelo . "[!] Horário da modificação: " . $dataModify . "\n"; 
                                            echo $bold . $amarelo . "[*] Data de instalação do Free Fire: " . $dataInstalacaoFormatada . "\n";
                                            echo $bold . $branco . "[#] Por favor, verifique no App Usage a data de instalação do Free Fire e compare com o horário da modificação. Se for diferente, aplique o W.O!\n\n";
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
                        echo $bold . $amarelo . "[!] Modificação em arquivo de shaders detectada. Arquivo: " . $arquivoSuspeito . "\n";
                        echo $bold . $amarelo . "[*] Hora da modificação: " . $dataModify . "\n";
                        echo $bold . $amarelo . "[*] Verifique se a modificação ocorreu após a partida!\n\n";
                    }
                } elseif ($encontrouReplayPassado) {
                    echo $bold . $vermelho . "[!] Possível modificação em arquivo de shaders detectada. Arquivo: " . $arquivoSuspeito . ", Horário: " . $dataModify . "\n";
                    echo $bold . $vermelho . "[*] Data de instalação do Free Fire: " . $dataInstalacaoFormatada . "\n";
                    echo $bold . $branco . "[#] Verifique cuidadosamente no App Usage a data de instalação do Free Fire!\n\n";
                } else {
                    echo $bold . $fverde . "[i] Nenhuma alteração suspeita encontrada.\n";
                }


                $comandoPastaShaders = 'adb shell "stat ' . escapeshellarg($diretorioShaders) . ' 2>/dev/null"';
                $resultadoPastaShaders = shell_exec($comandoPastaShaders);

                $encontrouBypassPasta = false;
                $encontrouReplayPassadoPasta = false;
                $dataModifyFormatada = '';
                $dataChangeFormatada = ''; 

                if (!empty($resultadoPastaShaders)) {
                    preg_match('/Modify: (.*?)\n/', $resultadoPastaShaders, $matchModify);
                    preg_match('/Change: (.*?)\n/', $resultadoPastaShaders, $matchChange);
                    preg_match('/Access: (.*?)\n/', $resultadoPastaShaders, $matchAccess);

                    if (!empty($matchModify[1]) && !empty($matchChange[1]) && !empty($matchAccess[1])) {
                        $dataModify = trim($matchModify[1]);
                        $dataChange = trim($matchChange[1]);
                        $dataAccess = trim($matchAccess[1]);

                        $dataModifyFormatada = preg_replace('/\.\d{9}.*$/', '', $dataModify);
                        $date = DateTime::createFromFormat('Y-m-d H:i:s', $dataModifyFormatada);
                        if ($date) {
                            $dataModifyFormatada = $date->format('d-m-Y H:i:s');
                        }

                        $dataChangeFormatada = preg_replace('/\.\d{9}.*$/', '', $dataChange);
                        $dateChange = DateTime::createFromFormat('Y-m-d H:i:s', $dataChangeFormatada);
                        if ($dateChange) {
                            $dataChangeFormatada = $dateChange->format('d-m-Y H:i:s');
                        }

                        if ($dataModify !== $dataChange) {
                            $encontrouBypassPasta = true;
                        }

                        if ($dataModify === $dataChange && $dataModify === $dataAccess) {
                            $encontrouReplayPassadoPasta = true;
                        }
                    }
                }

                if ($encontrouBypassPasta || $encontrouReplayPassadoPasta) {
                    echo $bold . $vermelho . "[!] Modificação suspeita detectada na pasta shaders! Aplique o W.O!\n";
                    echo $bold . $amarelo . "[*] Data da última modificação: " . $dataModifyFormatada . "\n\n";
                } else {
                    echo $bold . $fverde . "[i] Pasta shaders sem alterações suspeitas.\n";
                    if (!empty($dataModifyFormatada)) {
                        echo $bold . $amarelo . "[*] Data da última modificação: " . $dataModifyFormatada . "\n\n";
                    } else {
                        echo "\n";
                    }
                }

                echo "\n" . $bold . $amarelo . "[*] Data da última alteração na pasta 'gameassetbundles': " . ($dataChangeFormatada ?: "Não encontrada") . "\n";
                echo $bold . $branco . "[#] Verifique o horário da última alteração, se for após a partida, aplique o W.O!\n\n";

                $diretorioVerificar = "/sdcard/Android/data/com.dts.freefireth/files/contentcache/Optional/android"; 

                echo "[+] Verificando datas de modificação na pasta 'android'...\n";

                $comandoStat = 'adb shell stat ' . escapeshellarg($diretorioVerificar) . ' 2>&1';
                $resultadoStat = shell_exec($comandoStat);

                if (strpos($resultadoStat, 'File:') !== false) {
                    preg_match('/Access: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d+)/', $resultadoStat, $matchAccess);
                    preg_match('/Modify: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d+)/', $resultadoStat, $matchModify);
                    preg_match('/Change: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d+)/', $resultadoStat, $matchChange);

                    if ($matchAccess && $matchModify && $matchChange) {
                        $dataAccess = $matchAccess[1];
                        $dataModify = $matchModify[1];
                        $dataChange = $matchChange[1];

                        $dateModify = DateTime::createFromFormat('Y-m-d H:i:s.u', $dataModify);
                        if ($dateModify) {
                            $dataModifyFormatada = $dateModify->format('d-m-Y H:i:s');
                        }

                        if ($dataAccess === $dataModify && $dataModify === $dataChange) {
                            echo $bold . $vermelho . "[!] Possível bypass detectado - Datas idênticas\n";
                            echo $bold . $vermelho . "[i] Data: " . $dataModifyFormatada . "\n";
                        } elseif ($dataModify === $dataChange) {
                            echo $bold . $amarelo . "[i] Modificação da pasta: " . $dataModifyFormatada . "\n";
                        } else {
                            echo $bold . $vermelho . "[!] Discrepância encontrada\n";
                            $dateAccess = DateTime::createFromFormat('Y-m-d H:i:s.u', $dataAccess);
                            $dateChange = DateTime::createFromFormat('Y-m-d H:i:s.u', $dataChange);
                            if ($dateAccess && $dateChange) {
                                echo $bold . $amarelo . "[i] Acesso: " . $dateAccess->format('d-m-Y H:i:s') . "\n";
                                echo $bold . $amarelo . "[i] Modificação: " . $dataModifyFormatada . "\n";
                                echo $bold . $amarelo . "[i] Mudança: " . $dateChange->format('d-m-Y H:i:s') . "\n";
                            }
                        }
                    } else {
                        echo $bold . $vermelho . "[!] Não foi possível extrair datas. Resultado:\n";
                        echo $bold . $amarelo . $resultadoStat . "\n";
                    }
                } elseif (strpos($resultadoStat, 'No such file') !== false) {
                    echo $bold . $vermelho . "[!] Pasta não encontrada\n";
                } elseif (strpos($resultadoStat, 'Permission denied') !== false) {
                    echo $bold . $vermelho . "[!] Sem permissão de acesso\n";
                } else {
                    echo $bold . $vermelho . "[!] Erro desconhecido. Resultado:\n";
                    echo $resultadoStat . "\n";
                }

                echo $bold . $branco . "[+] Caso a pasta 'android' esteja modificada após o fim da partida, aplique o W.O!\n\n";

                $diretorioAvatarRes = "/sdcard/Android/data/com.dts.freefireth/files/contentcache/Optional/android/optionalavatarres/gameassetbundles";
                $diretorioOptionalAvatarRes = "/sdcard/Android/data/com.dts.freefireth/files/contentcache/Optional/android/optionalavatarres";

                // Verifica se a pasta gameassetbundles existe
                $comandoVerificarPasta = 'adb shell "test -d ' . escapeshellarg($diretorioAvatarRes) . ' && echo existe || echo naoexiste"';
                $resultadoVerificarPasta = trim((string)shell_exec($comandoVerificarPasta));

                $diretorioAlvo = "";
                $nomePasta = "";

                if ($resultadoVerificarPasta === "existe") {
                    $diretorioAlvo = $diretorioAvatarRes;
                    $nomePasta = "gameassetbundles";
                } else {
                    echo $vermelho . "[*] Pasta 'gameassetbundles' não encontrada, verificando a pasta 'optionalavatarres'...\n";
                    $diretorioAlvo = $diretorioOptionalAvatarRes;
                    $nomePasta = "optionalavatarres";
                }

                $comandoDataModify = 'adb shell stat -c "%y" ' . escapeshellarg($diretorioAlvo) . ' 2>/dev/null';
                $resultadoDataModify = trim((string)shell_exec($comandoDataModify));

                if ($resultadoDataModify !== '') {
                    try {
                        $dataModificacao = new DateTime($resultadoDataModify);
                        $agora = new DateTime("now");

                        echo $bold . $amarelo . "[*] Data de modificação na pasta '$nomePasta': " . $dataModificacao->format('d-m-Y H:i:s') . "\n";

                        $intervalo = $agora->getTimestamp() - $dataModificacao->getTimestamp();

                        if ($intervalo <= 3600) {
                            echo $bold . $vermelho . "[!] Possível Bypass detectado! Modificada há menos de 1 hora.\n";
                            echo $vermelho . "    Hora da modificação: " . $dataModificacao->format('H:i:s') . "\n";
                            echo $vermelho . "    Hora atual:          " . $agora->format('H:i:s') . "\n";
                        }

                    } catch (Exception $e) {
                        echo $vermelho . "[!] Erro ao extrair data de modificação da pasta '$nomePasta': " . $e->getMessage() . "\n";
                    }
                } else {
                    echo $vermelho . "[!] Não foi possível obter a data de modificação da pasta '$nomePasta'.\n";
                }


                $comandoListarArquivos = 'adb shell "find ' . escapeshellarg($diretorioAvatarRes) . ' -type f 2>/dev/null"';
                $resultadoArquivos = (string)shell_exec($comandoListarArquivos);
                $modificacaoDetectada = false;

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
                                    echo $bold . $vermelho . "[!] Modificação detectada no arquivo: $nomeArquivo! Aplique o W.O!\n\n";
                                    $modificacaoDetectada = true;
                                }
                            } catch (Exception $e) {
                                echo $vermelho . "[!] Erro ao verificar datas do arquivo $nomeArquivo: " . $e->getMessage() . "\n";
                            }
                        }
                    }

                    if (!$modificacaoDetectada) {
                        echo $bold . $fverde . "[i] Nenhuma alteração suspeita encontrada nos arquivos.\n\n";
                    }
                } else {
                    echo $vermelho . "[*] Sem itens baixados! Verifique se a data é após o fim da partida!\n\n";
                }


                echo $bold . $azul . "[+] Checando OBB...\n";

                $diretorioObb = "/sdcard/Android/obb/com.dts.freefireth";
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


                


            

                echo $bold . $branco . "[+] Após verificar in-game se o usuário está de Wallhack, olhando skins de armas e atrás da parede, verifique os horários do Shaders e OBB e compare também com o horário do replay, caso esteja muito diferente as datas, aplique o W.O!\n\n";

                echo $bold . $branco . "\n\n\t Obrigado por compactuar por um cenário limpo de cheats.\n";
                echo $bold . $branco . "\t                 Com carinho, Keller...\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";
        } elseif ($opcaoscanner == "2") {
            system("clear");
            keller_banner();

            if (!shell_exec("adb version > /dev/null 2>&1"))
            {
                system("pkg install -y android-tools > /dev/null 2>&1");
            }


            date_default_timezone_set('America/Sao_Paulo');
            shell_exec('adb start-server > /dev/null 2>&1');

    

            $comandoDispositivos = shell_exec("adb devices 2>&1");

                if (empty($comandoDispositivos) || strpos($comandoDispositivos, "device") === false || strpos($comandoDispositivos, "no devices") !== false) {
                    echo "\033[1;31m[!] Nenhum dispositivo encontrado. Faça o pareamento de IP ou conecte um dispositivo via USB.\n\n";
                    exit;
                }

                $comandoVerificarFF = shell_exec("adb shell pm list packages --user 0 | grep com.dts.freefiremax 2>&1");

                if (!empty($comandoVerificarFF) && strpos($comandoVerificarFF, "more than one device/emulator") !== false) {
                    echo $bold . $vermelho . "[!] Pareamento realizado de maneira incorreta, digite \"adb disconnect\" e refaça o processo.\n\n";
                    exit;
                }
                
                if (!empty($comandoVerificarFF) && strpos($comandoVerificarFF, "com.dts.freefiremax") !== false) {
                } else {
                    echo $bold . $vermelho . "[!] O FreeFire MAX está desinstalado, cancelando a telagem...\n\n";
                    exit;
                }


                $comandoVersaoAndroid = "adb shell getprop ro.build.version.release";
                $resultadoVersaoAndroid = shell_exec($comandoVersaoAndroid);

                if (!empty($resultadoVersaoAndroid)) {
                    echo $bold . $azul . "[+] Versão do Android: " . trim($resultadoVersaoAndroid) . "\n";
                } else {
                    echo $bold . $vermelho . "[!] Não foi possível obter a versão do Android.\n";
                }

                $comandoSu = 'su 2>&1';
                $resultadoSu = shell_exec($comandoSu);

                echo $bold . $azul . "[+] Checando se possui Root (se o programa travar, root detectado)...\n";
                if (!empty($resultadoSu) && strpos($resultadoSu, 'No su program found') !== false) {
                    echo $bold . $fverde . "[-] O dispositivo não tem root.\n\n";
                } else {
                    echo $bold . $vermelho . "[+] Root detectado no dispositivo Android.\n\n";
                }
                


            echo $bold . $azul . "[+] Checando se o dispositivo foi reiniciado recentemente...\n";
            $comandoUPTIME = shell_exec("adb shell uptime");

            if (preg_match('/up (\d+) min/', $comandoUPTIME, $filtros)) {
                $minutos = $filtros[1];
                echo $bold . $vermelho . "[!] O dispositivo foi iniciado recentemente (há $minutos minutos).\n\n";
            } else {
                echo $bold . $fverde . "[i] Dispositivo não reiniciado recentemente.\n\n";
            }


            $logcatTime = shell_exec("adb logcat -d -v time | head -n 2");
                preg_match('/(\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $logcatTime, $matchTime);

                if (!empty($matchTime[1])) {

                    $date = DateTime::createFromFormat('m-d H:i:s', $matchTime[1]);
                    $formattedDate = $date->format('d-m H:i:s'); 

                    echo $bold . $amarelo . "[+] Primeira log do sistema: " . $formattedDate . "\n";
                    echo $bold . $branco . "[+] Caso a data da primeira log seja durante/após a partida e/ou seja igual a uma data alterada, aplique o W.O!\n\n";

                } else {
                    echo $bold . $vermelho . "[!] Não foi possível capturar a data/hora do sistema.\n\n";
                }
            
            echo $bold . $azul . "[+] Verificando mudanças de data/hora...\n";

                
            $logcatOutput = shell_exec('adb logcat -d | grep "UsageStatsService: Time changed" | grep -v "HCALL"');

            if ($logcatOutput !== null && trim($logcatOutput) !== "") {
                $logLines = explode("\n", trim($logcatOutput));
            } else {
                echo $bold . $vermelho . "[!] Erro ao obter logs de modificação de data/hora, verifique a data da primeira log do sistema.\n\n";
            }


            $fusoHorario = trim(shell_exec('adb shell getprop persist.sys.timezone'));

            if ($fusoHorario !== "America/Sao_Paulo") {
                echo $bold . $amarelo . "[!] Aviso: O fuso horário do dispositivo é '$fusoHorario', diferente de 'America/Sao_Paulo', possivel tentativa de Bypass.\n\n";
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
                    echo $bold . $amarelo . "[!] Alterou horário de {$log['dataAntiga']} para {$log['dataNova']} {$log['horaNovaFormatada']} ({$log['acao']} horário)\n";
                }
            } else {
                echo $bold . $vermelho . "[!] Nenhum log de alteração de horário encontrado.\n\n";
            }

            

            echo $bold . $azul . "\n[+] Checando se modificou data e hora...\n";
            $autoTime = trim(shell_exec('adb shell settings get global auto_time'));
            $autoTimeZone = trim(shell_exec('adb shell settings get global auto_time_zone'));

            if ($autoTime !== "1" || $autoTimeZone !== "1") {
                echo $bold . $vermelho . "[!] Possível bypass detectado: data e hora/furo horário automático desativado.\n";
            } else {
                echo $bold . $fverde . "[i] Data e hora/fuso horário automático estão ativados.\n";
            }

            echo $bold . $branco . "[+] Caso haja mudança de horário durante/após a partida, aplique o W.O!\n\n";


            echo $bold . $azul . "[+] Obtendo os últimos acessos do Google Play Store...\n";

            $comandoUSAGE = shell_exec("adb shell dumpsys usagestats 2>/dev/null | grep -i 'MOVE_TO_FOREGROUND' 2>/dev/null | grep 'package=com.android.vending' 2>/dev/null | awk -F'time=\"' '{print \$2}' 2>/dev/null | awk '{gsub(/\"/, \"\"); print \$1, \$2}' 2>/dev/null | tail -n 5 2>/dev/null");

            if (!is_null($comandoUSAGE) && trim($comandoUSAGE) !== "") {
                echo $bold . $fverde . "[i] Últimos 5 acessos:\n";
                echo $amarelo . $comandoUSAGE . "\n";
            } else {
                echo $bold . "\e[31m[!] Nenhum dado encontrado.\n";
            }
            echo $bold . $branco . "[+] Caso haja acesso durante/após a partida, aplique o W.O!\n\n";

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

                        echo $bold . $amarelo . "[!] " . $data . " " . $hora . " " . $branco . "$conteudo" . "\n";
                    }
                }
            } else {
                echo $bold . "\e[31m[!] Nenhum dado encontrado.\n";
            }

            echo "\n";



            echo $bold . $azul . "[+] Checando se o replay foi passado...\n";

                $comandoArquivos = 'adb shell "ls -t /sdcard/Android/data/com.dts.freefiremax/files/MReplays/*.bin 2>/dev/null"';
                $output = shell_exec($comandoArquivos) ?? '';
                $arquivos = array_filter(explode("\n", trim($output)));
                
                $motivos = [];
                $arquivoMaisRecente = null;
                $ultimoModifyTime = null;
                $ultimoChangeTime = null;
                
                // Motivo 10 - Nenhum replay encontrado
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
                
                        $accessTime = strtotime($dataAccess);
                        $modifyTime = strtotime($dataModify);
                        $changeTime = strtotime($dataChange);
                
                        if ($indice === 0) {
                            $ultimoModifyTime = $modifyTime;
                            $ultimoChangeTime = $changeTime;
                        }
                
                        // Motivo 1 - Access posterior ao Modify
                        if ($accessTime > $modifyTime) {
                            $motivos[] = "Motivo 1 - Access posterior ao Modify " . basename($arquivo);
                        }
                
                        // Motivo 2 - Timestamps com .000
                        if (
                            preg_match('/\.0+$/', $dataAccess) ||
                            preg_match('/\.0+$/', $dataModify) ||
                            preg_match('/\.0+$/', $dataChange)
                        ) {
                            $motivos[] = "Motivo 2 - Timestamps com .000 " . basename($arquivo);
                        }
                
                        // Motivo 3 - Modify diferente de Change no arquivo
                        if ($dataModify !== $dataChange) {
                            $motivos[] = "Motivo 3 - Modify diferente de Change no arquivo " . basename($arquivo);
                        }
                
                        // Motivo 4 - Nome do arquivo não bate com Modify
                        if ($indice === 0) {
                            $arquivoMaisRecente = $arquivo;
                        
                            if (preg_match('/(\d{4}-\d{2}-\d{2}-\d{2}-\d{2}-\d{2})/', basename($arquivo), $match)) {
                                $nomeNormalizado = preg_replace(
                                    '/^(\d{4})-(\d{2})-(\d{2})-(\d{2})-(\d{2})-(\d{2})$/',
                                    '$1-$2-$3 $4:$5:$6',
                                    $match[1]
                                );
                                $nomeTimestamp = strtotime($nomeNormalizado);
                        
                                preg_match('/(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\.(\d+)/', $dataModify, $modifyParts);
                                $dataModifyBase = $modifyParts[1] ?? '';
                                $nanosModify = (int)($modifyParts[2] ?? 0);
                                $modifyTimestamp = strtotime($dataModifyBase);
                        
                                if ($nomeTimestamp !== false && $modifyTimestamp !== false) {
                                    $nomeNsTotal = $nomeTimestamp * 1_000_000_000;
                                    $modifyNsTotal = ($modifyTimestamp * 1_000_000_000) + $nanosModify;
                        
                                    $diffNs = abs($modifyNsTotal - $nomeNsTotal);
                        
                                    if ($diffNs > 1_000_000_000) {
                                        $motivos[] = "Motivo 4 - Nome do arquivo não bate com Modify: " . basename($arquivo);
                                    }
                                } else {
                                    $motivos[] = "Motivo 4 - erro ao converter timestamps (Modify: $dataModify, Nome: {$match[1]})";
                                }
                        
                               
                                
                            }
                        }
                        
                        
                
                        // Motivo 8 - Access do .json diferente dos tempos do .bin
                        $jsonPath = preg_replace('/\.bin$/', '.json', $arquivo);
                        $jsonStat = shell_exec('adb shell "stat ' . escapeshellarg($jsonPath) . ' 2>/dev/null"');
                        if ($jsonStat && preg_match('/Access: (.*?)\n/', $jsonStat, $matchJsonAccess)) {
                            $jsonAccess = trim(preg_replace('/ -\d{4}$/', '', $matchJsonAccess[1]));
                            $dataBinTimes = [$dataAccess, $dataModify, $dataChange];
                            if (!in_array($jsonAccess, $dataBinTimes)) {
                                $motivos[] = "Motivo 8 - Access do .json diferente dos tempos do .bin" . basename($jsonPath);
                            }
                        }
                        if (!$jsonStat) {
                            $motivos[] = "Motivo 8 - Arquivo JSON ausente: " . basename($jsonPath);
                        }

                    }
                }
                
                // Verificações na pasta MReplays
                $resultadoPasta = shell_exec('adb shell "stat /sdcard/Android/data/com.dts.freefiremax/files/MReplays 2>/dev/null"');
                if ($resultadoPasta) {
                    preg_match_all('/^(Access|Modify|Change):\s(\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}\.\d+)(?:\s[+-]\d{4})?/m', $resultadoPasta, $matches, PREG_SET_ORDER);
                    $timestamps = [];
                    foreach ($matches as $match) {
                        $timestamps[$match[1]] = trim($match[2]);
                    }
                
                    if (count($timestamps) === 3) {
                        $pastaModifyTime = strtotime($timestamps['Modify']);
                        $pastaChangeTime = strtotime($timestamps['Change']);
                
                        // Motivo 7 - Pasta modificada após o último replay
                        if ($ultimoModifyTime && $pastaModifyTime > $ultimoModifyTime) {
                            $motivos[] = "Motivo 7 - Pasta modificada após o último replay";
                        }
                        if ($ultimoChangeTime && $pastaChangeTime > $ultimoChangeTime) {
                            $motivos[] = "Motivo 7 - Pasta modificada após o último replay";
                        }
                
                        // Motivo 5 - Access, Modify e Change idênticos
                        if ($timestamps['Access'] === $timestamps['Modify'] && $timestamps['Modify'] === $timestamps['Change']) {
                            $motivos[] = "Motivo 5 - Access, Modify e Change idênticos";
                        }
                
                        // Motivo 6 - Milissegundos .000 na pasta
                        if (preg_match('/\.0+$/', $timestamps['Modify']) || preg_match('/\.0+$/', $timestamps['Change'])) {
                            $motivos[] = "Motivo 6 - Milissegundos .000 na pasta";
                        }
                
                        // Motivo 11 - Modify diferente de Change na pasta
                        if ($timestamps['Modify'] !== $timestamps['Change']) {
                            $motivos[] = "Motivo 11 - Modify diferente de Change na pasta";
                        }

                        // Motivo 12 - Change da pasta MReplays diferente dos Access dos arquivos
                        if (
                            $arquivoMaisRecente &&
                            isset($timestamps['Change'])
                        ) {
                            $changeMReplays = trim($timestamps['Change']);
                        
                            // 1) Stat do .bin
                            $statBin = shell_exec('adb shell "stat ' . escapeshellarg($arquivoMaisRecente) . ' 2>/dev/null"');
                            preg_match_all('/Access: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d+)(?: [-+]\d{4})?/', $statBin, $matchesBin);
                            $binAccess = isset($matchesBin[1]) ? end($matchesBin[1]) : '';
                        
                            // 2) Stat do .json
                            $jsonPath = preg_replace('/\.bin$/', '.json', $arquivoMaisRecente);
                            $statJson = shell_exec('adb shell "stat ' . escapeshellarg($jsonPath) . ' 2>/dev/null"');
                            preg_match_all('/Access: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d+)(?: [-+]\d{4})?/', $statJson, $matchesJson);
                            $jsonAccess = isset($matchesJson[1]) ? end($matchesJson[1]) : '';
                        
                            if ($binAccess !== $changeMReplays && $jsonAccess !== $changeMReplays) {
                                $motivos[] = "Motivo 12 - Change da pasta MReplays não bate com Access do .bin ou .json\n" .
                                            "Change MReplays: $changeMReplays\n" .
                                            "Access .bin:     $binAccess\n" .
                                            "Access .json:    $jsonAccess";
                            }
                        }
                        
                        



                
                        // Motivo 9 - Nome não bate com Modify da pasta + milissegundos suspeitos
                        if ($arquivoMaisRecente && isset($timestamps['Access'])) {
                            if (preg_match('/(\d{4}-\d{2}-\d{2}-\d{2}-\d{2}-\d{2})/', basename($arquivoMaisRecente), $match)) {
                                $nomeNormalizado = str_replace('-', '', $match[1]);
                                $modifyPastaNormalizado = str_replace(['-', ' ', ':'], '', $timestamps['Modify']);
                                if (preg_match('/\.(\d{2})(\d+)/', $timestamps['Access'], $milisegundosMatch)) {
                                    $doisPrimeiros = (int)$milisegundosMatch[1];
                                    $restante = $milisegundosMatch[2];
                                    $todosZeros = preg_match('/^0+$/', $milisegundosMatch[0]);
                                    $condicaoValida = ($doisPrimeiros <= 90 && preg_match('/^0+$/', $restante));
                                    if (($todosZeros || $condicaoValida) && $nomeNormalizado !== $modifyPastaNormalizado) {
                                        $motivos[] = "Motivo 9 - Nome não bate com Modify da pasta + milissegundos suspeitos" . basename($arquivoMaisRecente);
                                    }
                                }
                            }
                        }
                    }
                }
                
                $comandoLs = 'adb shell "ls -l /sdcard/Android/data/com.dts.freefiremax/files/MReplays/*.bin 2>/dev/null"';
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
                    echo $bold . $vermelho . "[!] Passador de replay detectado, aplique o W.O!\n";
                    foreach (array_unique($motivos) as $motivo) {
                        echo "    - " . $motivo . "\n";
                    }
                } else {
                    echo $bold . $fverde . "[i] Nenhum replay foi passado e a pasta MReplays está normal.\n";
                }




                if (!empty($resultadoPasta)) {
                    preg_match('/Access: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d+)/', $resultadoPasta, $matchAccessPasta);
                    
                    if (!empty($matchAccessPasta[1])) {
                        $dataAccessPasta = trim($matchAccessPasta[1]);
                        $dataAccessPastaSemMilesimos = preg_replace('/\.\d+.*$/', '', $dataAccessPasta);
                        
                        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dataAccessPastaSemMilesimos);
                        $dataFormatada = $dateTime ? $dateTime->format('d-m-Y H:i:s') : $dataAccessPastaSemMilesimos;

                        $cmd = "adb shell dumpsys package com.dts.freefiremax | grep -i firstInstallTime";
                        $firstInstallTime = shell_exec($cmd);

                        if (preg_match('/firstInstallTime=([\d-]+ \d{2}:\d{2}:\d{2})/', $firstInstallTime, $matches)) {
                            $dataInstalacao = trim($matches[1]);
                            $dateTimeInstalacao = DateTime::createFromFormat('Y-m-d H:i:s', $dataInstalacao);
                            $dataInstalacaoFormatada = $dateTimeInstalacao ? $dateTimeInstalacao->format('d-m-Y H:i:s') : "Formato inválido";
                        } else {
                            $dataInstalacaoFormatada = "Não encontrada";
                        }

                        echo $bold . $amarelo . "[+] Data de acesso da pasta MReplays: $dataFormatada\n";
                        echo $bold . $amarelo . "[*] Data de instalação do Free Fire: $dataInstalacaoFormatada\n";
                        echo $bold . $branco . "[#] Verifique a data de instalação do jogo com a data de acesso da pasta MReplays para ver se o jogo foi recém instalado antes da partida, se não, vá no histórico e veja se o player jogou outras partidas recentemente, se sim, aplique o W.O!\n\n";
                    } else {
                        echo $bold . $vermelho . "[!] Não foi possível obter a data de acesso da pasta MReplays\n\n";
                    }
                }





                                                    



                echo $bold . $azul . "[+] Checando bypass de Wallhack/Holograma...\n";


                $pastasParaVerificar = [
                    "/sdcard/Android/data/com.dts.freefiremax/files/contentcache/Optional/android/gameassetbundles",
                    "/sdcard/Android/data/com.dts.freefiremax/files/contentcache/Optional/android",
                    "/sdcard/Android/data/com.dts.freefiremax/files/contentcache/Optional",
                    "/sdcard/Android/data/com.dts.freefiremax/files/contentcache",
                    "/sdcard/Android/data/com.dts.freefiremax/files",
                    "/sdcard/Android/data/com.dts.freefiremax",
                    "/sdcard/Android/data",
                    "/sdcard/Android"
                ];



                $pastasParaVerificar2 = [
                    "/sdcard/Android/data/com.dts.freefiremax/files/contentcache/Optional/android/gameassetbundles",
                    "/sdcard/Android/data/com.dts.freefiremax/files/contentcache/Optional/android",
                    "/sdcard/Android/data/com.dts.freefiremax/files/contentcache/Optional",
                    "/sdcard/Android/data/com.dts.freefiremax/files/contentcache",
                    "/sdcard/Android/data/com.dts.freefiremax/files",
                    "/sdcard/Android/data/com.dts.freefiremax"
                ];

                

                foreach ($pastasParaVerificar as $pasta) {
                    $comandoStat = 'adb shell stat ' . escapeshellarg($pasta) . ' 2>&1';
                    $resultadoStat = shell_exec($comandoStat);
                
                    if (strpos($resultadoStat, 'File:') !== false) {
                        preg_match('/Modify: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d+)/', $resultadoStat, $matchModify);
                        preg_match('/Change: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d+)/', $resultadoStat, $matchChange);
                
                        if ($matchModify && $matchChange) {
                            $dataModify = trim($matchModify[1]);
                            $dataChange = trim($matchChange[1]);
                
                            $dataModifyFormatada = preg_replace('/\.\d+.*$/', '', $dataModify);
                            $dataChangeFormatada = preg_replace('/\.\d+.*$/', '', $dataChange);
                
                            if ($dataModifyFormatada !== $dataChangeFormatada) {
                                $nomefinalpasta = basename($pasta);
                                
                                $dateTimeChange = DateTime::createFromFormat('Y-m-d H:i:s', $dataChangeFormatada);
                                $dataChangeFormatadaLegivel = $dateTimeChange ? $dateTimeChange->format('d-m-Y H:i:s') : $dataChangeFormatada;
                                
                                echo $bold . $vermelho . "[!] Bypass de renomear/substituir na pasta: $nomefinalpasta! Confira se o horário é após a partida, se sim, aplique o W.O!\n";
                                echo $bold . $amarelo . "[i] Horário do renomeio/substituição: $dataChangeFormatadaLegivel\n\n";
                            }
                        }
                    }
                }

                $comandoFindBin = 'adb shell ls -t "/sdcard/Android/data/com.dts.freefiremax/files/MReplays" | grep "\.bin$" | head -n 1';
                $arquivoBinMaisRecente = shell_exec($comandoFindBin);

                if ($arquivoBinMaisRecente !== null && $arquivoBinMaisRecente !== '') {
                    $arquivoBinMaisRecente = trim($arquivoBinMaisRecente);
                    $caminhoCompletoBin = "/sdcard/Android/data/com.dts.freefiremax/files/MReplays/$arquivoBinMaisRecente";
                    $comandoStatBin = 'adb shell stat ' . escapeshellarg($caminhoCompletoBin) . ' 2>&1';
                    $resultadoStatBin = shell_exec($comandoStatBin);
                    preg_match('/Access: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $resultadoStatBin, $matchAccessBin);

                    if ($matchAccessBin) {
                        $dataAccessBin = $matchAccessBin[1];
                        $timestampAccessBinOriginal = strtotime($dataAccessBin);
                        $timestampAccessBinComMargem = $timestampAccessBinOriginal - (10 * 60); // -10 minutos

                        $pastasParaVerificar = [
                            "/sdcard/Android/data/com.dts.freefiremax/files/contentcache",
                            "/sdcard/Android/data/com.dts.freefiremax/files/contentcache/Optional/android"
                        ];

                        $bypassDetectado = false;
                        foreach ($pastasParaVerificar as $pasta) {
                            $comandoStat = 'adb shell stat ' . escapeshellarg($pasta) . ' 2>&1';
                            $resultadoStat = shell_exec($comandoStat);

                            preg_match('/Access: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $resultadoStat, $matchAccess);
                            preg_match('/Modify: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $resultadoStat, $matchModify);
                            preg_match('/Change: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $resultadoStat, $matchChange);

                            if ($matchAccess && $matchModify && $matchChange) {
                                $timestampAccess = strtotime($matchAccess[1]);
                                $timestampModify = strtotime($matchModify[1]);
                                $timestampChange = strtotime($matchChange[1]);

                                if (
                                    $timestampAccess > $timestampAccessBinComMargem ||
                                    $timestampModify > $timestampAccessBinComMargem ||
                                    $timestampChange > $timestampAccessBinComMargem
                                ) {
                                    $bypassDetectado = true;
                                    break;
                                }
                            }
                        }

                        if ($bypassDetectado) {
                            echo $bold . $vermelho . "[!] Modificando pastas após o fim da partida, aplique o W.O!\n\n";
                        } else {
                            echo $bold . $verde . "[+] Nenhum bypass de holograma detectado.\n\n";
                        }
                    } else {
                        echo $bold . $amarelo . "[!] Não foi possível obter a data do último .bin.\n";
                    }
                } else {
                    echo $bold . $vermelho . "[!] Nenhum .bin encontrado em MReplays.\n";
                }


                                $cmd = "adb shell dumpsys package com.dts.freefiremax | grep -i firstInstallTime";
                $firstInstallTime = shell_exec($cmd);

                $firstInstallDate = null;
                if (preg_match('/firstInstallTime=(\d{4}-\d{2}-\d{2})/', $firstInstallTime, $matchInstall)) {
                    $firstInstallDate = $matchInstall[1];
                }

                $cmdUpdate = "adb shell dumpsys package com.dts.freefiremax | grep -i lastUpdateTime";
                $lastUpdateTime = shell_exec($cmdUpdate);

                $lastUpdateDate = null;
                if (preg_match('/lastUpdateTime=(\d{4}-\d{2}-\d{2})/', $lastUpdateTime, $matchUpdate)) {
                    $lastUpdateDate = $matchUpdate[1];
                }

                $pastaShaders = "/sdcard/Android/data/com.dts.freefiremax/files/contentcache/Optional/android/gameassetbundles";

                $comandoFind = 'adb shell find ' . escapeshellarg($pastaShaders) . ' -name "shaders*" -type f 2>&1';
                $arquivosShaders = shell_exec($comandoFind);
                
                if (!empty($arquivosShaders)) {
                    $arquivosShaders = explode("\n", trim($arquivosShaders));
                
                    foreach ($arquivosShaders as $arquivo) {
                        if (empty($arquivo)) continue;
                
                        $comandoStat = 'adb shell stat ' . escapeshellarg($arquivo) . ' 2>&1';
                        $resultadoStat = shell_exec($comandoStat);
                
                        if (strpos($resultadoStat, 'File:') !== false) {
                            preg_match('/Access: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $resultadoStat, $matchAccess);
                            preg_match('/Modify: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $resultadoStat, $matchModify);
                            preg_match('/Change: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})/', $resultadoStat, $matchChange);
                
                            if ($matchAccess && $matchModify && $matchChange) {
                                $accessDate = $matchAccess[1];
                                $modifyDate = $matchModify[1];
                                $changeDate = $matchChange[1];
                
                                $nomeArquivo = basename($arquivo);
                
                                if ($accessDate === $modifyDate && $modifyDate === $changeDate) {
                                    $timestampArquivo = strtotime($accessDate);
                                    $ignorarAviso = false;
                                    
                                    if ($firstInstallDate) {
                                        $timestampInstalacao = strtotime($firstInstallDate);
                                        $diferencaSegundosInstall = abs($timestampArquivo - $timestampInstalacao);
                                        
                                        if ($diferencaSegundosInstall <= 86400) {
                                            $ignorarAviso = true;
                                        }
                                    }

                                    if (!$ignorarAviso && $lastUpdateDate) {
                                        $timestampAtualizacao = strtotime($lastUpdateDate);
                                        $diferencaSegundosUpdate = abs($timestampArquivo - $timestampAtualizacao);
                                        
                                        if ($diferencaSegundosUpdate <= 86400) {
                                            $ignorarAviso = true;
                                        }
                                    }
                                    
                                    if ($ignorarAviso) {
                                        continue;
                                    }
                                
                                    echo $bold . $laranja . "[!] Possível Bypass Holograma detectado (ACCESS, MODIFY, CHANGE iguais)\n";
                                    echo $bold . $laranja . "[!] Arquivo: $nomeArquivo\n";
                
                                    $dateTimeAccess = DateTime::createFromFormat('Y-m-d H:i:s', $accessDate);
                                    $dataAccessFormatada = $dateTimeAccess ? $dateTimeAccess->format('d-m-Y H:i:s') : $accessDate;
                
                                    $dateTimeInstall = DateTime::createFromFormat('Y-m-d H:i:s', $firstInstallDate);
                                    $dataInstallFormatada = $dateTimeInstall ? $dateTimeInstall->format('d-m-Y H:i:s') : $firstInstallDate;
                
                                    echo $bold . $laranja . "[!] Data da modificação (Access/Modify/Change): $dataAccessFormatada\n";
                                    echo $bold . $laranja . "[!] Data de instalação do FF: $dataInstallFormatada\n";
                                    
                                    if ($lastUpdateDate) {
                                        $dateTimeUpdate = DateTime::createFromFormat('Y-m-d H:i:s', $lastUpdateDate);
                                        $dataUpdateFormatada = $dateTimeUpdate ? $dateTimeUpdate->format('d-m-Y H:i:s') : $lastUpdateDate;
                                        echo $bold . $laranja . "[!] Data de atualização do FF: $dataUpdateFormatada\n";
                                    }
                                    
                                    echo $bold . $laranja . "[!] Se for após a partida, aplique o W.O!\n\n";
                                    continue;
                                }
                
                                if ($modifyDate !== $changeDate) {
                                    $dateTimeChange = DateTime::createFromFormat('Y-m-d H:i:s', $changeDate);
                                    $dataChangeFormatadaLegivel = $dateTimeChange ? $dateTimeChange->format('d-m-Y H:i:s') : $changeDate;
                
                                    echo $bold . $vermelho . "[!] Arquivo shader modificado: $nomeArquivo\n";
                                    echo $bold . $amarelo . "[i] Horário da modificação: $dataChangeFormatadaLegivel\n";
                                    echo $bold . $vermelho . "[!] Verifique se a data é após a partida, se sim aplique o W.O!\n\n";
                                }
                            }
                        }
                    }
                } else {
                    echo $bold . $amarelo . "[i] Nenhum arquivo de shader encontrado.\n";
                }



                $diretorioShaders = "/sdcard/Android/data/com.dts.freefiremax/files/contentcache/Optional/android/gameassetbundles";
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
                                    echo $bold . $amarelo . "[!] Possível bypass detectado: arquivo shader alterado recentemente.\n";
                                    echo $bold . $amarelo . "[!] Arquivo: $nomeArquivo\n";
                                    echo $bold . $amarelo . "[*] Hora da modificação: $dataModify\n";
                                    echo $bold . $amarelo . "[*] Hora atual: " . $currentDateTime->format('d-m-Y H:i:s') . "\n\n";
                                    $encontrouBypass = true;
                                    $arquivoSuspeito = $nomeArquivo;
                                    break;
                                }
                
                                $cmd = "adb shell dumpsys package com.dts.freefiremax | grep -i firstInstallTime";
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
                                            echo $bold . $amarelo . "[!] Arquivo shader modificado: " . $nomeArquivo . "\n";
                                            echo $bold . $amarelo . "[!] Horário da modificação: " . $dataModify . "\n"; 
                                            echo $bold . $amarelo . "[*] Data de instalação do Free Fire: " . $dataInstalacaoFormatada . "\n";
                                            echo $bold . $branco . "[#] Por favor, verifique no App Usage a data de instalação do Free Fire e compare com o horário da modificação. Se for diferente, aplique o W.O!\n\n";
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
                        echo $bold . $amarelo . "[!] Modificação em arquivo de shaders detectada. Arquivo: " . $arquivoSuspeito . "\n";
                        echo $bold . $amarelo . "[*] Hora da modificação: " . $dataModify . "\n";
                        echo $bold . $amarelo . "[*] Verifique se a modificação ocorreu após a partida!\n\n";
                    }
                } elseif ($encontrouReplayPassado) {
                    echo $bold . $vermelho . "[!] Possível modificação em arquivo de shaders detectada. Arquivo: " . $arquivoSuspeito . ", Horário: " . $dataModify . "\n";
                    echo $bold . $vermelho . "[*] Data de instalação do Free Fire: " . $dataInstalacaoFormatada . "\n";
                    echo $bold . $branco . "[#] Verifique cuidadosamente no App Usage a data de instalação do Free Fire!\n\n";
                } else {
                    echo $bold . $fverde . "[i] Nenhuma alteração suspeita encontrada.\n";
                }


                $comandoPastaShaders = 'adb shell "stat ' . escapeshellarg($diretorioShaders) . ' 2>/dev/null"';
                $resultadoPastaShaders = shell_exec($comandoPastaShaders);

                $encontrouBypassPasta = false;
                $encontrouReplayPassadoPasta = false;
                $dataModifyFormatada = '';
                $dataChangeFormatada = ''; 

                if (!empty($resultadoPastaShaders)) {
                    preg_match('/Modify: (.*?)\n/', $resultadoPastaShaders, $matchModify);
                    preg_match('/Change: (.*?)\n/', $resultadoPastaShaders, $matchChange);
                    preg_match('/Access: (.*?)\n/', $resultadoPastaShaders, $matchAccess);

                    if (!empty($matchModify[1]) && !empty($matchChange[1]) && !empty($matchAccess[1])) {
                        $dataModify = trim($matchModify[1]);
                        $dataChange = trim($matchChange[1]);
                        $dataAccess = trim($matchAccess[1]);

                        $dataModifyFormatada = preg_replace('/\.\d{9}.*$/', '', $dataModify);
                        $date = DateTime::createFromFormat('Y-m-d H:i:s', $dataModifyFormatada);
                        if ($date) {
                            $dataModifyFormatada = $date->format('d-m-Y H:i:s');
                        }

                        $dataChangeFormatada = preg_replace('/\.\d{9}.*$/', '', $dataChange);
                        $dateChange = DateTime::createFromFormat('Y-m-d H:i:s', $dataChangeFormatada);
                        if ($dateChange) {
                            $dataChangeFormatada = $dateChange->format('d-m-Y H:i:s');
                        }

                        if ($dataModify !== $dataChange) {
                            $encontrouBypassPasta = true;
                        }

                        if ($dataModify === $dataChange && $dataModify === $dataAccess) {
                            $encontrouReplayPassadoPasta = true;
                        }
                    }
                }

                if ($encontrouBypassPasta || $encontrouReplayPassadoPasta) {
                    echo $bold . $vermelho . "[!] Modificação suspeita detectada na pasta shaders! Aplique o W.O!\n";
                    echo $bold . $amarelo . "[*] Data da última modificação: " . $dataModifyFormatada . "\n\n";
                } else {
                    echo $bold . $fverde . "[i] Pasta shaders sem alterações suspeitas.\n";
                    if (!empty($dataModifyFormatada)) {
                        echo $bold . $amarelo . "[*] Data da última modificação: " . $dataModifyFormatada . "\n\n";
                    } else {
                        echo "\n";
                    }
                }

                echo "\n" . $bold . $amarelo . "[*] Data da última alteração na pasta 'gameassetbundles': " . ($dataChangeFormatada ?: "Não encontrada") . "\n";
                echo $bold . $branco . "[#] Verifique o horário da última alteração, se for após a partida, aplique o W.O!\n\n";

                $diretorioVerificar = "/sdcard/Android/data/com.dts.freefiremax/files/contentcache/Optional/android"; 

                echo "[+] Verificando datas de modificação na pasta 'android'...\n";

                $comandoStat = 'adb shell stat ' . escapeshellarg($diretorioVerificar) . ' 2>&1';
                $resultadoStat = shell_exec($comandoStat);

                if (strpos($resultadoStat, 'File:') !== false) {
                    preg_match('/Access: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d+)/', $resultadoStat, $matchAccess);
                    preg_match('/Modify: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d+)/', $resultadoStat, $matchModify);
                    preg_match('/Change: (\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d+)/', $resultadoStat, $matchChange);

                    if ($matchAccess && $matchModify && $matchChange) {
                        $dataAccess = $matchAccess[1];
                        $dataModify = $matchModify[1];
                        $dataChange = $matchChange[1];

                        $dateModify = DateTime::createFromFormat('Y-m-d H:i:s.u', $dataModify);
                        if ($dateModify) {
                            $dataModifyFormatada = $dateModify->format('d-m-Y H:i:s');
                        }

                        if ($dataAccess === $dataModify && $dataModify === $dataChange) {
                            echo $bold . $vermelho . "[!] Possível bypass detectado - Datas idênticas\n";
                            echo $bold . $vermelho . "[i] Data: " . $dataModifyFormatada . "\n";
                        } elseif ($dataModify === $dataChange) {
                            echo $bold . $amarelo . "[i] Modificação da pasta: " . $dataModifyFormatada . "\n";
                        } else {
                            echo $bold . $vermelho . "[!] Discrepância encontrada\n";
                            $dateAccess = DateTime::createFromFormat('Y-m-d H:i:s.u', $dataAccess);
                            $dateChange = DateTime::createFromFormat('Y-m-d H:i:s.u', $dataChange);
                            if ($dateAccess && $dateChange) {
                                echo $bold . $amarelo . "[i] Acesso: " . $dateAccess->format('d-m-Y H:i:s') . "\n";
                                echo $bold . $amarelo . "[i] Modificação: " . $dataModifyFormatada . "\n";
                                echo $bold . $amarelo . "[i] Mudança: " . $dateChange->format('d-m-Y H:i:s') . "\n";
                            }
                        }
                    } else {
                        echo $bold . $vermelho . "[!] Não foi possível extrair datas. Resultado:\n";
                        echo $bold . $amarelo . $resultadoStat . "\n";
                    }
                } elseif (strpos($resultadoStat, 'No such file') !== false) {
                    echo $bold . $vermelho . "[!] Pasta não encontrada\n";
                } elseif (strpos($resultadoStat, 'Permission denied') !== false) {
                    echo $bold . $vermelho . "[!] Sem permissão de acesso\n";
                } else {
                    echo $bold . $vermelho . "[!] Erro desconhecido. Resultado:\n";
                    echo $resultadoStat . "\n";
                }

                echo $bold . $branco . "[+] Caso a pasta 'android' esteja modificada após o fim da partida, aplique o W.O!\n\n";

                $diretorioAvatarRes = "/sdcard/Android/data/com.dts.freefiremax/files/contentcache/Optional/android/optionalavatarres/gameassetbundles";
                $diretorioOptionalAvatarRes = "/sdcard/Android/data/com.dts.freefiremax/files/contentcache/Optional/android/optionalavatarres";

                // Verifica se a pasta gameassetbundles existe
                $comandoVerificarPasta = 'adb shell "test -d ' . escapeshellarg($diretorioAvatarRes) . ' && echo existe || echo naoexiste"';
                $resultadoVerificarPasta = trim((string)shell_exec($comandoVerificarPasta));

                $diretorioAlvo = "";
                $nomePasta = "";

                if ($resultadoVerificarPasta === "existe") {
                    $diretorioAlvo = $diretorioAvatarRes;
                    $nomePasta = "gameassetbundles";
                } else {
                    echo $vermelho . "[*] Pasta 'gameassetbundles' não encontrada, verificando a pasta 'optionalavatarres'...\n";
                    $diretorioAlvo = $diretorioOptionalAvatarRes;
                    $nomePasta = "optionalavatarres";
                }

                $comandoDataModify = 'adb shell stat -c "%y" ' . escapeshellarg($diretorioAlvo) . ' 2>/dev/null';
                $resultadoDataModify = trim((string)shell_exec($comandoDataModify));

                if ($resultadoDataModify !== '') {
                    try {
                        $dataModificacao = new DateTime($resultadoDataModify);
                        $agora = new DateTime("now");

                        echo $bold . $amarelo . "[*] Data de modificação na pasta '$nomePasta': " . $dataModificacao->format('d-m-Y H:i:s') . "\n";

                        $intervalo = $agora->getTimestamp() - $dataModificacao->getTimestamp();

                        if ($intervalo <= 3600) {
                            echo $bold . $vermelho . "[!] Possível Bypass detectado! Modificada há menos de 1 hora.\n";
                            echo $vermelho . "    Hora da modificação: " . $dataModificacao->format('H:i:s') . "\n";
                            echo $vermelho . "    Hora atual:          " . $agora->format('H:i:s') . "\n";
                        }

                    } catch (Exception $e) {
                        echo $vermelho . "[!] Erro ao extrair data de modificação da pasta '$nomePasta': " . $e->getMessage() . "\n";
                    }
                } else {
                    echo $vermelho . "[!] Não foi possível obter a data de modificação da pasta '$nomePasta'.\n";
                }


                $comandoListarArquivos = 'adb shell "find ' . escapeshellarg($diretorioAvatarRes) . ' -type f 2>/dev/null"';
                $resultadoArquivos = (string)shell_exec($comandoListarArquivos);
                $modificacaoDetectada = false;

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
                                    echo $bold . $vermelho . "[!] Modificação detectada no arquivo: $nomeArquivo! Aplique o W.O!\n\n";
                                    $modificacaoDetectada = true;
                                }
                            } catch (Exception $e) {
                                echo $vermelho . "[!] Erro ao verificar datas do arquivo $nomeArquivo: " . $e->getMessage() . "\n";
                            }
                        }
                    }

                    if (!$modificacaoDetectada) {
                        echo $bold . $fverde . "[i] Nenhuma alteração suspeita encontrada nos arquivos.\n\n";
                    }
                } else {
                    echo $vermelho . "[*] Sem itens baixados! Verifique se a data é após o fim da partida!\n\n";
                }


                echo $bold . $azul . "[+] Checando OBB...\n";

                $diretorioObb = "/sdcard/Android/obb/com.dts.freefiremax";
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


                


            

                echo $bold . $branco . "[+] Após verificar in-game se o usuário está de Wallhack, olhando skins de armas e atrás da parede, verifique os horários do Shaders e OBB e compare também com o horário do replay, caso esteja muito diferente as datas, aplique o W.O!\n\n";

                echo $bold . $branco . "\n\n\t Obrigado por compactuar por um cenário limpo de cheats.\n";
                echo $bold . $branco . "\t                 Com carinho, Keller...\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";
        } elseif ($opcaoscanner == 's' || $opcaoscanner == 'S') {
            echo "\n\n\t Obrigado por compactuar por um cenário limpo de cheats.\n\n";
            die();
        }
      }
?>