<div id="top">

<p align="center">

<picture>
  <source media="(prefers-color-scheme: dark)" srcset="https://i.imgur.com/QRlCrO3.png">
  <source media="(prefers-color-scheme: light)" srcset="https://i.imgur.com/QRlCrO3.png">
  <img alt="ReadmeAI Logo" src="https://i.imgur.com/QRlCrO3.png" width="60%">
</picture>

</p>

<p align="center">
  <em>Pensado e realizado em prol da comunidade de FreeFire, por KellerSS.</em>
</p>



</div>

<img src="https://i.imgur.com/NnWf7Fm.png" alt="line break" width="100%" height="3px">


## Introdução

KellerSS é um scanner para dispositivos Android que tem o objetivo de reunir logs e arquivos suspeitos em questão de segundos de utilização.

**Por que usar o KellerSS?**

O projeto tem como principal função facilitar o trabalho dos analistas em suas telagens, que contem várias funções, como:

* **🔵 Automação:** O scanner faz todo o trabalho pesado por você, poupando seu tempo.
* **⚫️ Logs suspeitas:** Reune log's de todos possíves bypass para você automaticamente.
* **🟣 Facilidade:** O scanner roda utilizando `Termux`, e com alguns simples comandos você já vai estar rodando ele sem problemas.


## Como utilizar?



#### <img width="2%" src="https://simpleicons.org/icons/diagramsdotnet.svg">&emsp13; Faça o download do Termux:


| Aplicativo                  | Descrição                |
|----------------------------|---------------------------|
| [Termux](https://cdn.discordapp.com/attachments/1348094420620279849/1353232408635248720/Termux_ALLIANCE.apk?ex=67eacaa4&is=67e97924&hm=d782777ad6e4d9b90eb62a19fb94b98efb4c4630a7a9383510884daf02cc7ab7&) | Terminal utilizado para rodar o scanner   |
| [Tutorial](https://www.youtube.com/watch?v=RF7O1MHThsE&t=8s) | Tutorial ensinando a como utilizar   |





#### <img width="2%" src="https://simpleicons.org/icons/gnometerminal.svg">&emsp13; Rode utilizando o Termux:

#### <img width="2%" src="https://simpleicons.org/icons/termius.svg">&emsp13; Após abrir o Termux, dividindo a tela com o pareamento wifi aberto, rode os comandos abaixo:

```sh
❯ adb pair localhost:porta codigopareamento

```

#### <img width="2%" src="https://simpleicons.org/icons/termius.svg">&emsp13; Após parear, a porta irá atualizar, então suba nas opções e confira a nova porta.

```sh
❯ adb connect localhost:portaatualizada

```

#### <img width="2%" src="https://simpleicons.org/icons/termius.svg">&emsp13; Após parear e conectar corretamente, só rodar o código que irá baixar e executar o scanner.

```sh
❯ pkg install git php android-tools -y && rm -rf KellerSS-Android && git clone https://github.com/kellerzz/KellerSS-Android && cd KellerSS-Android && php KellerSS.php

```


<img src="https://i.imgur.com/NnWf7Fm.png" alt="line break" width="100%" height="3px">


## Detecções



| Detecções               | Descrição                                   |
|----------------------|-----------------------------------------------|
| `Verificação da instalação do FreeFire`            | Verificar se o jogo está instalado                      | `center`        |
| `Reinicialização do dispositivo`              | Verifica se o dispositivo foi reiniciado a menos de 60 minutos                      |  
| `Versão Android`      | Verifica a versão do Android                |
| `Root`      | Verifica se o dispositivo possui Root                      |
| `Data e Hora`     | Verifica bypass de Data e Hora                       |
| `Passagem de Replay` | Verifica se o usuário passou Replay                      | 
| `MTP`           | Verifica se o MTP está ativado  |
| `Shaders`             | Verifica se o usuário deu bypass usando wallhack/holograma                            | 
| `OBB`        | Verifica se o usuário deu algum tipo de bypass na OBB                               |


<sub>

</sub>

<img src="https://i.imgur.com/NnWf7Fm.png" alt="line break" width="100%" height="3px">

## Contribuições

Contribuições são bem vindas! Por favor me chame no privado do discord `keller22cao`.

* **🐛 [Reporte um Problema](https://discord.gg/allianceoficial)**: Encontrou um bug? Me avise!
* **💬 [Faça uma sugestão](https://discord.gg/allianceoficial)**: Tem ideias ou sugestões? Eu adoraria lhe ouvir.
<br>


## Agradecimentos

Um grande agradecimento aos membros abaixo por seu trabalho incrível e contribuições sobre bypass:


<div style="text-align:; font-weight: bold; margin-bottom: 10px;">
  ㅤKellerㅤㅤSheikㅤ ㅤRibeiroㅤㅤㅤPxㅤㅤㅤㅤHgㅤㅤApela
</div>

<table>
  <tr>
    <td style="text-align: center; margin-right: 20px;">
      <a href="https://www.instagram.com/kellerffx">
        <img src="https://i.imgur.com/25Qrvbh.png" alt="kellerSS" style="width: 50px; height: 50px;">
      </a>
    </td>
    <td style="text-align: center; margin-right: 20px;">
      <a href="https://discord.gg/allianceoficial">
        <img src="https://i.imgur.com/DkHpc3a.jpeg" alt="sheik" style="width: 50px; height: 50px; object-fit: cover;">
      </a>
    </td>
    <td style="text-align: center; margin-right: 20px;">
      <a href="https://www.instagram.com/Ribeirowxz">
        <img src="https://i.imgur.com/xqmiMSG.png" alt="ribeiro" style="width: 50px; height: 50px;">
      </a>
    </td>
    <td style="text-align: center;">
      <a href="https://www.instagram.com/pedrww7_">
        <img src="https://i.imgur.com/8BUhE5T.jpeg" alt="PX" style="width: 50px; height: 50px;">
      </a>
    </td>
        </td>
    <td style="text-align: center; margin-right: 20px;">
      <a href="https://www.instagram.com/_hugomoises">
        <img src="https://i.imgur.com/8QVfHn2.png" alt="ribeiro" style="width: 50px; height: 50px;">
      </a>
    </td>
    <td style="text-align: center;">
      <a href="https://discord.gg/allianceoficial">
        <img src="https://i.imgur.com/Fyk08YR.jpeg" alt="PX" style="width: 50px; height: 50px;">
      </a>
    </td>
  </tr>
</table>






## 🎗 Licença

Copyright KellerSS © 2025-2030.<br />

<div align="left">
</div>

<img src="https://i.imgur.com/NnWf7Fm.png" alt="line break" width="100%" height="3px">
