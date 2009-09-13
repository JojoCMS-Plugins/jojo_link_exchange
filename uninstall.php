<?php

/* remove the FAQ page from the menu */
Jojo::deleteQuery("DELETE FROM `page` WHERE pg_link='jojo_link_exchange.php'");