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

function rst(): string
{
    return C['rst'];
}

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

// ─── MAIN ────────────────────────────────────────────────────────────────────

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
echo c('cinza') . "    pkg install git php -y && rm -rf KellerSS-Android && git clone https://github.com/kellerzz/KellerSS-Android && cd KellerSS-Android && php KellerSS.php\n" . rst();

echo "\n";

info("Comando NOVO:");
echo c('bold', 'verde') . "    pkg update -y && pkg install wget android-tools -y && rm -f KellerSS && wget https://raw.githubusercontent.com/kellerzz/KellerSS-Android/main/KellerSS && chmod +x KellerSS && ./KellerSS\n" . rst();

echo "\n";
echo c('bold', 'ciano') . "  → Instalando automaticamente o novo scanner...\n" . rst();
echo "\n";

// Executa o novo comando
$cmd = 'pkg update -y && pkg install wget android-tools -y && rm -f KellerSS && wget https://raw.githubusercontent.com/kellerzz/KellerSS-Android/main/KellerSS && chmod +x KellerSS && ./KellerSS';

passthru($cmd, $codigo);

if ($codigo !== 0) {
    echo "\n";
    erro("Falha ao instalar/executar o novo scanner (código: $codigo).");
    erro("Execute manualmente o comando NOVO acima.");
}
