<?php 
function ReelGen($rg)
{
    $_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11 = explode('reelStrip', file_get_contents(base_path() . '/app/Games/ZhaoCaiJinBaoPTM/reels.txt'));
    $_obf_0D3C090E192F3D26100429351F02123B310C3504040132 = sha1($rg . $_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[4] . $_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[2] . $_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[3] . $GLOBALS['rgrc'] . $_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[0] . $_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[1]);
    $GLOBALS['rgrc'] = $GLOBALS['rgrc'] + 3;
    return md5($_obf_0D3C090E192F3D26100429351F02123B310C3504040132);
}
function CheckReels($rc)
{
    $_obf_0D3C090E192F3D26100429351F02123B310C3504040132 = [];
    $_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11 = explode('reelStrip', file_get_contents(base_path() . '/app/Games/ZhaoCaiJinBaoPTM/reels.txt'));
    $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel1'] = sha1($_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[0]);
    $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel2'] = sha1($_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[1]);
    $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel3'] = sha1($_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[2]);
    $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel4'] = sha1($_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[3]);
    $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel5'] = sha1($_obf_0D3B08361E271C090B3302333D04171B03073B0E1A2E11[4]);
    $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['rp'] = $GLOBALS['rgrc'];
    $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801 = md5($_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel1'] . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel2'] . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel3'] . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel4'] . $_obf_0D3C090E192F3D26100429351F02123B310C3504040132['reel5'] . $GLOBALS['rgrc'] . $rc);
    return $_obf_0D3E3F180910322B2E5C0F2E0F31295C3E380809112801;
}
