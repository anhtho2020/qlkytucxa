<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title> My favorite records  </title>
        <style rel='stylesheet' type='text/css'>
body {
    margin: 0;
}
/*table {
    width: 100%;
    border: thin solid black;
    border-collapse: collapse;*/
/*}*/
/*td {
    border: thin solid black;
}*/
/*th, tfoot td {
    border: thin solid black;
    text-align: center;
    font-weight: bold;
}*/
tbody td {
    font-size: 120%;
}
caption {
    font-size: 100%;
    text-align: right;
}
td, th, caption {
    padding: 20px;
}
        </style>
    </head>
    <body>
        <table>
            <caption>
                Table: My favorite records.
            </caption>
            <colgroup>
                <col id='album' />
                <col id='artist' />
                <col id='released' />
            </colgroup>
            <thead>
                <tr>
                    <th> album            </th>
                    <th> artist           </th>
                    <th> released         </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> R</td>
                    <td> T</td>
                    <td> 1</td>
                </tr>
                <tr>
                    <td> B</td>
                    <td> V</td>
                    <td> 1</td>
                </tr>
                <tr>
                    <td> Q</td>
                    <td> Q</td>
                    <td> 1</td>
                </tr>
                <tr>
                    <td> M</td>
                    <td> T</td>
                    <td> 1</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td> album            </td>
                    <td> artist           </td>
                    <td> released         </td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
