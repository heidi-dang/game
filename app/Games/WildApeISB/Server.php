<?php 
namespace VanguardLTE\Games\WildApeISB
{
    include('CheckReels.php');
    class Server
    {
        public function get($request, $game)
        {
           /* if( config('LicenseDK.APL_INCLUDE_KEY_CONFIG') != 'wi9qydosuimsnls5zoe5q298evkhim0ughx1w16qybs2fhlcpn' ) 
            {
                return false;
            }
            if( md5_file(base_path() . '/app/Lib/LicenseDK.php') != '3c5aece202a4218a19ec8c209817a74e' ) 
            {
                return false;
            }
            if( md5_file(base_path() . '/config/LicenseDK.php') != '951a0e23768db0531ff539d246cb99cd' ) 
            {
                return false;
            }
            $checked = new \VanguardLTE\Lib\LicenseDK();
            $license_notifications_array = $checked->aplVerifyLicenseDK(null, 0);
            if( $license_notifications_array['notification_case'] != 'notification_license_ok' ) 
            {
                $response = '{"responseEvent":"error","responseType":"error","serverResponse":"Error LicenseDK"}';
                exit( $response );
            }*/
            \DB::beginTransaction();
            $userId = \Auth::id();
            if( $userId == null ) 
            {
                $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid login"}';
                exit( $response );
            }
            $slotSettings = new SlotSettings($game, $userId);
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822 = $_POST;
            $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01 = [];
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = '';
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] = explode("\n", $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['cmd']);
            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'] = trim($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'][0]);
            $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 = (string)$_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['command'];
            switch( $_obf_0D1725391C1C0A3529182B263529401F0E1322380B1A32 ) 
            {
                case '1':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "undefined" , "data": { "logout": "1" } } }';
                    break;
                case '5814':
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = [];
                    for( $i = 0; $i < count($slotSettings->Bet); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[] = $slotSettings->Bet[$i] * 100;
                    }
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round($slotSettings->GetBalance() * 100);
                    $lastEvent = $slotSettings->GetHistory();
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                    if( $lastEvent != 'NULL' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->bonusWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                        $slotSettings->SetGameData($slotSettings->slotId . 'freeGamesSym', $lastEvent->serverResponse->freeGamesSym);
                        $reels = $lastEvent->serverResponse->reelsSymbols;
                        $lines = $lastEvent->serverResponse->slotLines;
                        $bet = $lastEvent->serverResponse->slotBet * 100;
                    }
                    else
                    {
                        $lines = 10;
                        $bet = $slotSettings->Bet[0] * 100;
                    }
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                    {
                        $bonusWin = $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin');
                        $_obf_0D3C0F0B011A0F36193631392A1938330B1E241C235B01 = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                        $_obf_0D0110310E3D180C0F042B065C2F2833284021033E0B32 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                        $_obf_0D2B212D321E2F13251A11275B252D3E120622091F1722 = '"freeGames": { "left": "' . ($_obf_0D0110310E3D180C0F042B065C2F2833284021033E0B32 - $_obf_0D3C0F0B011A0F36193631392A1938330B1E241C235B01) . '", "total": "' . $_obf_0D0110310E3D180C0F042B065C2F2833284021033E0B32 . '", "totalFreeGamesWinnings": "' . round($bonusWin * 100) . '", "totalFreeGamesWinningsMoney": "' . round($bonusWin * 100) . '", "multiplier": "1", "totalMultiplier": "1" },';
                        $_obf_0D2B212D321E2F13251A11275B252D3E120622091F1722 = '';
                    }
                    else
                    {
                        $_obf_0D2B212D321E2F13251A11275B252D3E120622091F1722 = '';
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "5640f7f3-4693-4059-841a-dc3afd3f1925", "data": { "version": { "versionServer": "2.2.0.1-1", "versionGMAPI": "8.1.16 GS:2.5.1 FR:v4" }, "balance": { "cashBalance": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "freeBalance": "0", "ccyCode": "EUR", "ccyDecimal": { }, "ccyThousand": { }, "ccyPrefix": { }, "ccySuffix": { }, "ccyDecimalDigits": { } }, "id": { "roundId": "25520020301588680413177316196800814753252699" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "readValue": "1" }, "initial": { "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "coins": "1", "coinValue": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "lines": "20", "currentState": "beginGame", "lastGame": { "endGame": { ' . $_obf_0D2B212D321E2F13251A11275B252D3E120622091F1722 . '"money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "bet": "' . ($_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] * 20) . '", "symbols": { "line": [ "-1--1--1--1--1", "-1--1--1--1--1", "-1--1--1--1--1" ] }, "lines": { }, "totalWinnings": "0", "totalWinningsMoney": "0", "doubleWin": { "totalWinnings": "0", "totalWinningsMoney": "0", "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '" }, "totalMultiplier": { }, "bonusRequest": { } } } } } } }';
                    break;
                case '192837':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "419427a2-d300-41d9-8d67-fe4eec61be5f", "data": "1" } }';
                    break;
                case '5347':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "26d1001c-15ff-4d21-af9e-45dde0260165", "data": { "success": "" } } }';
                    break;
                case '8':
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "f5186317-f615-411d-8167-3dcbbcd630cb", "data": { "bonusChoice": { "bonusId": "1", "choicesOrder": "0-0-0-0-0-0", "bonusGain": "0-0-0-0-0-0", "bonusGainMoney": "0-0-0-0-0-0", "choicesWinnings": "10-15-20-30-40-50", "totalBonusWinnings": "0", "totalBonusWinningsMoney": "0", "choicesMult": "1-1-1-1-1-1", "totalMultiplier": "1", "choicesFreeGames": "6-8-10-12-15-20" }, "gameSpecific": { "choicesOrderWilds": "0-0-0-0-0-0", "choicesOrderFreespins": "0-0-0-0-0-0" } } } }';
                    break;
                case '9':
                    $_obf_0D3F1239363430233E3C0F0E15191F5B3B392F323E0122 = explode("\n", $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['cmd']);
                    $select = trim($_obf_0D3F1239363430233E3C0F0E15191F5B3B392F323E0122[1]);
                    $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = round($slotSettings->GetBalance() * 100);
                    $_obf_0D07102E160D125C370A213D1D2A0817283E3B012F1D32 = 0;
                    $freeGamesSym = [];
                    $_obf_0D30013D04111B330F2B1D37281F3D3E25095C25273E22 = [
                        6, 
                        8, 
                        10, 
                        12, 
                        15, 
                        20
                    ];
                    $_obf_0D3805040D2F012725285B161B02322E3E0E290A0A0122 = [
                        10, 
                        15, 
                        20, 
                        30, 
                        40, 
                        50
                    ];
                    $_obf_0D3D1F403B051731392F3513165C305C32111807303011 = rand(0, 5);
                    $_obf_0D2204142519280D041C19110513132724013D2F1D0432 = rand(0, 5);
                    $_obf_0D115B161C3611161F252F40135B5C21303C1131093132 = [
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0
                    ];
                    $_obf_0D1B133E0F2F2B3127262B160D3818222937401A323801 = [
                        0, 
                        0, 
                        0, 
                        0, 
                        0, 
                        0
                    ];
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $_obf_0D30013D04111B330F2B1D37281F3D3E25095C25273E22[$_obf_0D3D1F403B051731392F3513165C305C32111807303011]);
                    $slotSettings->SetGameData($slotSettings->slotId . 'freeGamesSym', $_obf_0D3805040D2F012725285B161B02322E3E0E290A0A0122[$_obf_0D2204142519280D041C19110513132724013D2F1D0432]);
                    for( $i = 0; $i < 6; $i++ ) 
                    {
                        if( $i == $_obf_0D3D1F403B051731392F3513165C305C32111807303011 ) 
                        {
                            $_obf_0D115B161C3611161F252F40135B5C21303C1131093132[$i] = 1;
                        }
                        if( $i == $_obf_0D2204142519280D041C19110513132724013D2F1D0432 ) 
                        {
                            $_obf_0D1B133E0F2F2B3127262B160D3818222937401A323801[$i] = 1;
                        }
                    }
                    $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "f5186317-f615-411d-8167-3dcbbcd630cb", "data": { "bonusWin": { "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "bonusRequest": "0", "bonusId": "1", "bonusesLeft": "0", "totalFreeGames": "' . $_obf_0D30013D04111B330F2B1D37281F3D3E25095C25273E22[$_obf_0D3D1F403B051731392F3513165C305C32111807303011] . '", "multiplier": "1", "totalMultiplier": "1", "choicesFreeGames": "6-8-10-12-15-20", "totalBonusWinnings": "0", "totalBonusWinningsMoney": "0", "choicesOrder": "' . implode('-', $_obf_0D1B133E0F2F2B3127262B160D3818222937401A323801) . '", "choicesWinnings": "10-15-20-30-40-50", "choicesMult": "1-1-1-1-1-1", "totalWinnings": "0", "totalWinningsMoney": "0", "freeGamesWin": { "total": "' . $_obf_0D30013D04111B330F2B1D37281F3D3E25095C25273E22[$_obf_0D3D1F403B051731392F3513165C305C32111807303011] . '", "multiplier": "1" } }, "gameSpecific": { "choicesOrderWilds": "' . implode('-', $_obf_0D1B133E0F2F2B3127262B160D3818222937401A323801) . '", "choicesOrderFreespins": "' . implode('-', $_obf_0D115B161C3611161F252F40135B5C21303C1131093132) . '", "feature": "bonusFreeSpins" }, "doubleWin": { "totalWinnings": "0", "totalWinningsMoney": "0", "money": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '" }, "balance": { "cashBalance": "' . $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 . '", "freeBalance": "0" } } } }';
                    break;
                case '2':
                    $_obf_0D3F1239363430233E3C0F0E15191F5B3B392F323E0122 = explode("\n", $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['cmd']);
                    $linesId = [];
                    $linesId[0] = [
                        2, 
                        2, 
                        2, 
                        2, 
                        2
                    ];
                    $linesId[1] = [
                        1, 
                        1, 
                        1, 
                        1, 
                        1
                    ];
                    $linesId[2] = [
                        3, 
                        3, 
                        3, 
                        3, 
                        3
                    ];
                    $linesId[3] = [
                        1, 
                        2, 
                        3, 
                        2, 
                        1
                    ];
                    $linesId[4] = [
                        3, 
                        2, 
                        1, 
                        2, 
                        3
                    ];
                    $linesId[5] = [
                        1, 
                        2, 
                        1, 
                        2, 
                        1
                    ];
                    $linesId[6] = [
                        2, 
                        3, 
                        2, 
                        3, 
                        2
                    ];
                    $linesId[7] = [
                        2, 
                        1, 
                        2, 
                        1, 
                        2
                    ];
                    $linesId[8] = [
                        3, 
                        2, 
                        3, 
                        2, 
                        3
                    ];
                    $linesId[9] = [
                        1, 
                        1, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[10] = [
                        2, 
                        2, 
                        1, 
                        2, 
                        2
                    ];
                    $linesId[11] = [
                        1, 
                        1, 
                        2, 
                        3, 
                        3
                    ];
                    $linesId[12] = [
                        3, 
                        3, 
                        2, 
                        1, 
                        1
                    ];
                    $linesId[13] = [
                        3, 
                        3, 
                        1, 
                        3, 
                        3
                    ];
                    $linesId[14] = [
                        1, 
                        1, 
                        3, 
                        1, 
                        1
                    ];
                    $linesId[15] = [
                        2, 
                        3, 
                        1, 
                        3, 
                        2
                    ];
                    $linesId[16] = [
                        2, 
                        1, 
                        3, 
                        1, 
                        2
                    ];
                    $linesId[17] = [
                        1, 
                        3, 
                        1, 
                        3, 
                        1
                    ];
                    $linesId[18] = [
                        3, 
                        1, 
                        3, 
                        1, 
                        3
                    ];
                    $linesId[19] = [
                        3, 
                        1, 
                        1, 
                        1, 
                        3
                    ];
                    $linesId[20] = [
                        4, 
                        4, 
                        4, 
                        4, 
                        4
                    ];
                    $linesId[21] = [
                        2, 
                        3, 
                        4, 
                        3, 
                        2
                    ];
                    $linesId[22] = [
                        4, 
                        3, 
                        2, 
                        3, 
                        4
                    ];
                    $linesId[23] = [
                        3, 
                        4, 
                        3, 
                        4, 
                        3
                    ];
                    $linesId[24] = [
                        4, 
                        3, 
                        4, 
                        3, 
                        4
                    ];
                    $linesId[25] = [
                        3, 
                        3, 
                        4, 
                        3, 
                        3
                    ];
                    $linesId[26] = [
                        4, 
                        4, 
                        3, 
                        4, 
                        4
                    ];
                    $linesId[27] = [
                        2, 
                        2, 
                        3, 
                        4, 
                        4
                    ];
                    $linesId[28] = [
                        4, 
                        4, 
                        3, 
                        2, 
                        2
                    ];
                    $linesId[29] = [
                        4, 
                        4, 
                        2, 
                        4, 
                        4
                    ];
                    $linesId[30] = [
                        2, 
                        2, 
                        4, 
                        2, 
                        2
                    ];
                    $linesId[31] = [
                        3, 
                        4, 
                        2, 
                        4, 
                        3
                    ];
                    $linesId[32] = [
                        3, 
                        2, 
                        4, 
                        2, 
                        3
                    ];
                    $linesId[33] = [
                        2, 
                        4, 
                        2, 
                        4, 
                        2
                    ];
                    $linesId[34] = [
                        4, 
                        2, 
                        4, 
                        2, 
                        4
                    ];
                    $linesId[35] = [
                        1, 
                        1, 
                        4, 
                        1, 
                        1
                    ];
                    $linesId[36] = [
                        4, 
                        4, 
                        1, 
                        4, 
                        4
                    ];
                    $linesId[37] = [
                        1, 
                        4, 
                        4, 
                        4, 
                        1
                    ];
                    $linesId[38] = [
                        4, 
                        1, 
                        4, 
                        1, 
                        4
                    ];
                    $linesId[39] = [
                        1, 
                        4, 
                        1, 
                        4, 
                        1
                    ];
                    $lines = 20;
                    $betline = trim($_obf_0D3F1239363430233E3C0F0E15191F5B3B392F323E0122[1]) / 100;
                    $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222 = trim($_obf_0D3F1239363430233E3C0F0E15191F5B3B392F323E0122[1]);
                    $allbet = $betline * $lines;
                    $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                    if( $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') < $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') ) 
                    {
                        $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'freespin';
                    }
                    if( $slotSettings->GetBalance() < $allbet && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'bet' ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid balance "}';
                        exit( $response );
                    }
                    if( $allbet <= 0 ) 
                    {
                        $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid bet "}';
                        exit( $response );
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] != 'freespin' ) 
                    {
                        if( !isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ) 
                        {
                            $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] = 'bet';
                        }
                        $slotSettings->SetBalance(-1 * $allbet, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622 = $allbet / 100 * $slotSettings->GetPercent();
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), $_obf_0D1A310E2B25282C1A01072A06330C1A173E3437092622, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        $_obf_0D262A401E2428360E103910312E0E2A2D04280B345B11 = $slotSettings->UpdateJackpots($allbet);
                        $slotSettings->SetGameData($slotSettings->slotId . 'JackWinID', $_obf_0D262A401E2428360E103910312E0E2A2D04280B345B11['isJackId']);
                        $slotSettings->SetGameData($slotSettings->slotId . 'freeGamesSym', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                        $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                        $bonusMpl = 1;
                    }
                    else
                    {
                        $lines = 40;
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') + 1);
                        $bonusMpl = $slotSettings->slotFreeMpl;
                    }
                    $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22 = $slotSettings->GetSpinSettings($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'], $allbet, $lines);
                    $winType = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[0];
                    $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D31103E3B3D1E1A27051D1540063B0528291C5C1A0D22[1];
                    if( $winType == 'bonus' && $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $winType = 'none';
                    }
                    $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 = round($slotSettings->GetBalance() * 100);
                    for( $i = 0; $i <= 2000; $i++ ) 
                    {
                        $totalWin = 0;
                        $lineWins = [];
                        $cWins = [
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0, 
                            0
                        ];
                        $wild = ['10'];
                        $scatter = '11';
                        $reels = $slotSettings->GetReelStrips($winType, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                        if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                        {
                            $_obf_0D1E073E170D1B1632040F0D2D0D33243C072311180211 = $slotSettings->GetGameData($slotSettings->slotId . 'freeGamesSym');
                            $_obf_0D160C090E2C162A3F173D383127252B25080332281101 = [
                                10, 
                                10, 
                                10, 
                                10, 
                                10, 
                                10, 
                                10, 
                                10, 
                                10, 
                                10, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0, 
                                0
                            ];
                            if( $_obf_0D1E073E170D1B1632040F0D2D0D33243C072311180211 == 15 ) 
                            {
                                $_obf_0D160C090E2C162A3F173D383127252B25080332281101 = [
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0
                                ];
                            }
                            else if( $_obf_0D1E073E170D1B1632040F0D2D0D33243C072311180211 == 20 ) 
                            {
                                $_obf_0D160C090E2C162A3F173D383127252B25080332281101 = [
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0
                                ];
                            }
                            else if( $_obf_0D1E073E170D1B1632040F0D2D0D33243C072311180211 == 30 ) 
                            {
                                $_obf_0D160C090E2C162A3F173D383127252B25080332281101 = [
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0
                                ];
                            }
                            else if( $_obf_0D1E073E170D1B1632040F0D2D0D33243C072311180211 == 40 ) 
                            {
                                $_obf_0D160C090E2C162A3F173D383127252B25080332281101 = [
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0
                                ];
                            }
                            else if( $_obf_0D1E073E170D1B1632040F0D2D0D33243C072311180211 == 50 ) 
                            {
                                $_obf_0D160C090E2C162A3F173D383127252B25080332281101 = [
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    10, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0, 
                                    0
                                ];
                            }
                            shuffle($_obf_0D160C090E2C162A3F173D383127252B25080332281101);
                            $_obf_0D01373C192C15080B363D173B2B3B373715020B360432 = 0;
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                for( $p = 0; $p <= 3; $p++ ) 
                                {
                                    if( $_obf_0D160C090E2C162A3F173D383127252B25080332281101[$_obf_0D01373C192C15080B363D173B2B3B373715020B360432] != 0 ) 
                                    {
                                        $reels['reel' . $r][$p] = '10';
                                    }
                                    $_obf_0D01373C192C15080B363D173B2B3B373715020B360432++;
                                }
                            }
                        }
                        for( $k = 0; $k < $lines; $k++ ) 
                        {
                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '';
                            for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                            {
                                $_obf_0D011C142C3C37263F351C4012170A074027083F321132 = (string)$slotSettings->SymbolGame[$j];
                                if( $_obf_0D011C142C3C37263F351C4012170A074027083F321132 == $scatter || !isset($slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132]) ) 
                                {
                                }
                                else
                                {
                                    $s = [];
                                    $sp = [];
                                    $s[0] = $reels['reel1'][$linesId[$k][0] - 1];
                                    $s[1] = $reels['reel2'][$linesId[$k][1] - 1];
                                    $s[2] = $reels['reel3'][$linesId[$k][2] - 1];
                                    $s[3] = $reels['reel4'][$linesId[$k][3] - 1];
                                    $s[4] = $reels['reel5'][$linesId[$k][4] - 1];
                                    $sp[0] = $linesId[$k][0];
                                    $sp[1] = $linesId[$k][1];
                                    $sp[2] = $linesId[$k][2];
                                    $sp[3] = $linesId[$k][3];
                                    $sp[4] = $linesId[$k][4];
                                    if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) ) 
                                    {
                                        $mpl = 1;
                                        if( in_array($s[0], $wild) && in_array($s[1], $wild) ) 
                                        {
                                            $mpl = 1;
                                        }
                                        else if( in_array($s[0], $wild) || in_array($s[1], $wild) ) 
                                        {
                                            $mpl = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][2] * $betline * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{ "pos": "' . $k . '", "initialValue": { }, "initialValueMoney": { }, "value": "' . round(($cWins[$k] * 100) / $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222) . '", "valueMoney": "' . ($cWins[$k] * 100) . '", "hl": "' . $sp[0] . '' . $sp[1] . '000", "symbolId": "22", "multiplier": "' . $mpl . '" }';
                                        }
                                    }
                                    if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) ) 
                                    {
                                        $mpl = 1;
                                        if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) ) 
                                        {
                                            $mpl = 1;
                                        }
                                        else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) ) 
                                        {
                                            $mpl = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][3] * $betline * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{ "pos": "' . $k . '", "initialValue": { }, "initialValueMoney": { }, "value": "' . round(($cWins[$k] * 100) / $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222) . '", "valueMoney": "' . ($cWins[$k] * 100) . '", "hl": "' . $sp[0] . '' . $sp[1] . '' . $sp[2] . '00", "symbolId": "22", "multiplier": "' . $mpl . '" }';
                                        }
                                    }
                                    if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) && ($s[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[3], $wild)) ) 
                                    {
                                        $mpl = 1;
                                        if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) && in_array($s[3], $wild) ) 
                                        {
                                            $mpl = 1;
                                        }
                                        else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) || in_array($s[3], $wild) ) 
                                        {
                                            $mpl = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][4] * $betline * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{ "pos": "' . $k . '", "initialValue": { }, "initialValueMoney": { }, "value": "' . round(($cWins[$k] * 100) / $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222) . '", "valueMoney": "' . ($cWins[$k] * 100) . '", "hl": "' . $sp[0] . '' . $sp[1] . '' . $sp[2] . '' . $sp[3] . '0", "symbolId": "22", "multiplier": "' . $mpl . '" }';
                                        }
                                    }
                                    if( ($s[0] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[0], $wild)) && ($s[1] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[1], $wild)) && ($s[2] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[2], $wild)) && ($s[3] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[3], $wild)) && ($s[4] == $_obf_0D011C142C3C37263F351C4012170A074027083F321132 || in_array($s[4], $wild)) ) 
                                    {
                                        $mpl = 1;
                                        if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) && in_array($s[3], $wild) && in_array($s[4], $wild) ) 
                                        {
                                            $mpl = 1;
                                        }
                                        else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) || in_array($s[3], $wild) || in_array($s[4], $wild) ) 
                                        {
                                            $mpl = $slotSettings->slotWildMpl;
                                        }
                                        $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 = $slotSettings->Paytable['SYM_' . $_obf_0D011C142C3C37263F351C4012170A074027083F321132][5] * $betline * $mpl * $bonusMpl;
                                        if( $cWins[$k] < $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01 ) 
                                        {
                                            $cWins[$k] = $_obf_0D0D163F1706133D0A110219022A07303D371E1C0A0F01;
                                            $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 = '{ "pos": "' . $k . '", "initialValue": { }, "initialValueMoney": { }, "value": "' . round(($cWins[$k] * 100) / $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222) . '", "valueMoney": "' . ($cWins[$k] * 100) . '", "hl": "' . $sp[0] . '' . $sp[1] . '' . $sp[2] . '' . $sp[3] . '' . $sp[4] . '", "symbolId": "22", "multiplier": "' . $mpl . '" }';
                                        }
                                    }
                                }
                            }
                            if( $cWins[$k] > 0 && $_obf_0D0207283039073919263232090A382F3D26101F0D1E11 != '' ) 
                            {
                                array_push($lineWins, $_obf_0D0207283039073919263232090A382F3D26101F0D1E11);
                                $totalWin += $cWins[$k];
                            }
                        }
                        $scattersWin = 0;
                        $scattersStr = '';
                        $scattersCount = 0;
                        $_obf_0D312B19262C083426241E0D392E22282324060B380811 = [];
                        for( $p = 0; $p <= 2; $p++ ) 
                        {
                            for( $r = 1; $r <= 5; $r++ ) 
                            {
                                if( $reels['reel' . $r][$p] == $scatter ) 
                                {
                                    $scattersCount++;
                                    $_obf_0D312B19262C083426241E0D392E22282324060B380811[] = '1';
                                }
                                else
                                {
                                    $_obf_0D312B19262C083426241E0D392E22282324060B380811[] = '0';
                                }
                            }
                        }
                        $scattersWin = $slotSettings->Paytable['SYM_' . $scatter][$scattersCount] * $allbet;
                        $_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832 = 0;
                        if( $scattersCount >= 3 ) 
                        {
                            $_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832 = $slotSettings->slotFreeCount;
                            $scattersStr = ', "bonusRequest": "1", "bonuses": { "bonus": { "id": "1", "hl": "' . implode('', $_obf_0D312B19262C083426241E0D392E22282324060B380811) . '" } } ';
                        }
                        $totalWin += $scattersWin;
                        if( $i > 1000 ) 
                        {
                            $winType = 'none';
                        }
                        if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($allbet * rand(2, 5)) ) 
                        {
                        }
                        else if( !$slotSettings->increaseRTP && $winType == 'win' && $allbet < $totalWin ) 
                        {
                        }
                        else
                        {
                            if( $i > 1500 ) 
                            {
                                $response = '{"responseEvent":"error","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":"Bad Reel Strip"}';
                                exit( $response );
                            }
                            if( $scattersCount >= 3 && $winType != 'bonus' ) 
                            {
                            }
                            else if( $totalWin <= $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 && $winType == 'bonus' ) 
                            {
                                $_obf_0D163F390C080D0831380D161E12270D0225132B261501 = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                                if( $_obf_0D163F390C080D0831380D161E12270D0225132B261501 < $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 ) 
                                {
                                    $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D163F390C080D0831380D161E12270D0225132B261501;
                                }
                                else
                                {
                                    break;
                                }
                            }
                            else if( $totalWin > 0 && $totalWin <= $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 && $winType == 'win' ) 
                            {
                                $_obf_0D163F390C080D0831380D161E12270D0225132B261501 = $slotSettings->GetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''));
                                if( $_obf_0D163F390C080D0831380D161E12270D0225132B261501 < $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 ) 
                                {
                                    $_obf_0D3B3C113639391705311B0F12323C3B3B250C1A142401 = $_obf_0D163F390C080D0831380D161E12270D0225132B261501;
                                }
                                else
                                {
                                    break;
                                }
                            }
                            else if( $totalWin == 0 && $winType == 'none' ) 
                            {
                                break;
                            }
                        }
                    }
                    if( $totalWin > 0 ) 
                    {
                        $slotSettings->SetBank((isset($_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']) ? $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] : ''), -1 * $totalWin);
                        $slotSettings->SetBalance($totalWin);
                    }
                    $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32 = $totalWin;
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') + $totalWin);
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') + $totalWin);
                        $_obf_0D1A3E15343531081F13061E15332D2C3B403D0F100901 = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                    }
                    else
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $totalWin);
                    }
                    $fs = 0;
                    if( $scattersCount >= 3 ) 
                    {
                        if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') > 0 ) 
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') + $slotSettings->slotFreeCount);
                        }
                        else
                        {
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeStartWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $totalWin);
                            $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $slotSettings->slotFreeCount);
                        }
                        $fs = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                    }
                    $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 = implode(',', $lineWins);
                    $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 = '' . json_encode($reels) . '';
                    $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 = '' . json_encode($slotSettings->Jackpots) . '';
                    $response = '{"responseEvent":"spin","responseType":"' . $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] . '","serverResponse":{"freeGamesSym":' . $slotSettings->GetGameData($slotSettings->slotId . 'freeGamesSym') . ',"slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') . ',"Balance":' . $slotSettings->GetBalance() . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . '],"Jackpots":' . $_obf_0D1B370B073F123C3210300C0336351F3E072217172A22 . ',"reelsSymbols":' . $_obf_0D140A1C122D065B2A1629031B280E272815082A0D2122 . '}}';
                    $slotSettings->SaveLogReport($response, $allbet, $lines, $_obf_0D23292E1910310B2D0F382A090D063F2A132521111C32, $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent']);
                    $_obf_0D061022045C2D252E2B08293C341621081C363D5B3301 = '';
                    $_obf_0D21152412095C03222D3808130C3C012907290C181E22 = $slotSettings->GetGameData($slotSettings->slotId . 'Cards');
                    $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 = '';
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('"' . $reels['reel1'][0] . '-' . $reels['reel2'][0] . '-' . $reels['reel3'][0] . '-' . $reels['reel4'][0] . '-' . $reels['reel5'][0] . '"');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= (',"' . $reels['reel1'][1] . '-' . $reels['reel2'][1] . '-' . $reels['reel3'][1] . '-' . $reels['reel4'][1] . '-' . $reels['reel5'][1] . '"');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= (',"' . $reels['reel1'][2] . '-' . $reels['reel2'][2] . '-' . $reels['reel3'][2] . '-' . $reels['reel4'][2] . '-' . $reels['reel5'][2] . '"');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= (',"' . $reels['reel1'][3] . '-' . $reels['reel2'][3] . '-' . $reels['reel3'][3] . '-' . $reels['reel4'][3] . '-' . $reels['reel5'][3] . '"');
                    }
                    else
                    {
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ('"' . $reels['reel1'][0] . '-' . $reels['reel2'][0] . '-' . $reels['reel3'][0] . '-' . $reels['reel4'][0] . '-' . $reels['reel5'][0] . '"');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= (',"' . $reels['reel1'][1] . '-' . $reels['reel2'][1] . '-' . $reels['reel3'][1] . '-' . $reels['reel4'][1] . '-' . $reels['reel5'][1] . '"');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= (',"' . $reels['reel1'][2] . '-' . $reels['reel2'][2] . '-' . $reels['reel3'][2] . '-' . $reels['reel4'][2] . '-' . $reels['reel5'][2] . '"');
                        $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 .= ',"-1--1--1--1--1"';
                    }
                    $_obf_0D2D1F17141D3509383B2328141A060130300A0A242A11 = 'false';
                    if( $totalWin > 0 ) 
                    {
                        $state = 'gamble';
                    }
                    else
                    {
                        $state = 'idle';
                    }
                    if( !isset($_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832) ) 
                    {
                        $fs = 0;
                    }
                    else if( $_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832 > 0 ) 
                    {
                        $fs = $_obf_0D330F222111261D3F242C1840282A3C3F3F0C070A1832;
                    }
                    else
                    {
                        $fs = 0;
                    }
                    $_obf_0D1F37013027092805312223153703290C250F17350C22 = round($slotSettings->GetBalance() * 100);
                    $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11 = [];
                    for( $i = 0; $i < count($slotSettings->Bet); $i++ ) 
                    {
                        $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[] = $slotSettings->Bet[$i] * 100;
                    }
                    if( $_obf_0D221D1040101E0C18152D38350A220B2431190A3E1822['slotEvent'] == 'freespin' ) 
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "d01cf0d7-074f-4524-86be-3361658789f3", "data": { "balance": { "cashBalance": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '", "freeBalance": "0" }, "id": { "roundId": "25520003501587914269973255464480393810966409" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "' . $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11[0] . '", "readValue": "0" }, "endGame": { "money": "' . $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 . '", "bet": "25", "symbols": { "line": [  ' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . '  ] }, "lines": { "line": [ ' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . ' ] }, "freeGames": { "left": "' . ($slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') - $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame')) . '", "total": "' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '", "totalFreeGamesWinnings": "' . (($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) / $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222) . '", "totalFreeGamesWinningsMoney": "' . ($slotSettings->GetGameData($slotSettings->slotId . 'BonusWin') * 100) . '", "multiplier": "1", "totalMultiplier": "1" }, "totalWinnings": "' . round(($totalWin * 100) / $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "totalMultiplier": "1", "bonusRequest": "0", "gameSpecific": { "numberOfBonusWilds": "' . $slotSettings->GetGameData($slotSettings->slotId . 'freeGamesSym') . '", "numberOfBonusFreeSpins": "' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') . '", "feature": "bonusFreeSpins" }  }, "doubleWin": { "totalWinnings": "' . round(($totalWin * 100) / $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '" } } } }';
                    }
                    else
                    {
                        $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0] = '{ "rootdata": { "uid": "4a9c1e10-6c60-47d5-96bd-b29d90fb2fdf", "data": { "balance": { "cashBalance": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '", "freeBalance": "0" }, "id": { "roundId": "255847301588771993201680869966859645524153" }, "coinValues": { "coinValueList": "' . implode(',', $_obf_0D34145C302B1D0101103437210F3D3C2D1C3836051D11) . '", "coinValueDefault": "1", "readValue": "1" }, "endGame": { "money": "' . $_obf_0D2117010C3F18242E2C38131A330F270B3E2224115C11 . '", "bet": "20", "symbols": { "line": [ ' . $_obf_0D0C2D02303D05261238144030211A030D5C28401C0F32 . ' ] }, "lines": {  "line": [' . $_obf_0D33120B1B18292D30293B191C3D383E3D2D0C195B2101 . ']}, "totalWinnings": "' . round(($totalWin * 100) / $_obf_0D042F25385C10140F5C0B0D2932082A321D12153B1222) . '", "totalWinningsMoney": "' . round($totalWin * 100) . '", "totalMultiplier": "1", "bonusRequest": "0" ' . $scattersStr . '}, "doubleWin": { "totalWinnings": "0", "totalWinningsMoney": "0", "money": "' . $_obf_0D1F37013027092805312223153703290C250F17350C22 . '" } } } }';
                        $slotSettings->SetGameData($slotSettings->slotId . 'LastResponse', $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0]);
                    }
                    break;
            }
            $response = $_obf_0D0C042906245B03073E5C11081A210E351540320D2B01[0];
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}
