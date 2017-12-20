<?php
$file = "images/logo.gif";
$mim = mime_type($file);

function mime_type($file) {

    // there's a bug that doesn't properly detect
    // the mime type of css files
    // https://bugs.php.net/bug.php?id=53035
    // so the following is used, instead
    // src: http://www.freeformatter.com/mime-types-list.html#mime-types-list

    $mime_type = array(
        "3dml" => "text/vnd.in3d.3dml",
        "3g2" => "video/3gpp2",
        "3gp" => "video/3gpp",
        "7z" => "application/x-7z-compressed",
        "aab" => "application/x-authorware-bin",
        "aac" => "audio/x-aac",
        "aam" => "application/x-authorware-map",
        "aas" => "application/x-authorware-seg",
        "abw" => "application/x-abiword",
        "ac" => "application/pkix-attr-cert",
        "acc" => "application/vnd.americandynamics.acc",
        "ace" => "application/x-ace-compressed",
        "acu" => "application/vnd.acucobol",
        "adp" => "audio/adpcm",
        "aep" => "application/vnd.audiograph",
        "afp" => "application/vnd.ibm.modcap",
        "ahead" => "application/vnd.ahead.space",
        "ai" => "application/postscript",
        "aif" => "audio/x-aiff",
        "air" => "application/vnd.adobe.air-application-installer-package+zip",
        "ait" => "application/vnd.dvb.ait",
        "ami" => "application/vnd.amiga.ami",
        "apk" => "application/vnd.android.package-archive",
        "application" => "application/x-ms-application",
        // etc...
        // truncated due to Stack Overflow's character limit in posts
    );

    $extension = \strtolower(\pathinfo($file, \PATHINFO_EXTENSION));

    if (isset($mime_type[$extension])) {
        return $mime_type[$extension];
    } else {
        throw new \Exception("Unknown file type");
    }

}


?>