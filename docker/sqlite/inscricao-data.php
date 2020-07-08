<?php
/**
 * inscricao-data
 *
 * Cria db inscricao
 * @author UnBMaster <unbmaster@outlook.com>
 * @license GNU General Public License (GPL)
 * @version 0.1.0
 */

unlink('/db/inscricao.db');

$sql = file_get_contents('inscricao.sql');

$db = new SQLite3('/db/inscricao.db');

chmod('/db/inscricao.db', 0777);

chown('/db/inscricao.db', 'www-data');

chgrp('/db/inscricao.db', 'www-data');


$db->query($sql);

echo "Ok\n";