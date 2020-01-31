<?php

if (!function_exists('e')) {
    function e($string)
    {
        if ($string) {
            return htmlspecialchars($string);
            //return htmlsentities($string, ENT_QUOTES, 'UTF-8', false);
            //return strip_tags($string);
        }
    }
}

// Cell count
// Retourne le nombre d'enregistrement dans une table donnée
if (!function_exists('cell_count')) {
    function cell_count($table, $field_name, $field_value)
    {
        global $db;
        $q = $db->prepare("SELECT * FROM $table WHERE $field_name = ?");
        $q->execute([$field_value]);
        return $q->rowCount();
    }
}


if (!function_exists('remember_me')) {
    function remember_me($user_id)
    {
        global $db;

        // Générer un token de maniere aleatoire
        $token = openssl_random_pseudo_bytes(24);

        // Générer le sélecteur de maniere aleatoire et s'assurer
        // que ce dernier est unique
        do {
            $selector = openssl_random_pseudo_bytes(9);
        } while (cell_count('auth_tokens', 'selector', $selector) > 0);

        // Sauvez les infos (user_id, selector, expires(14 jours), token(hashed))
        // en bdd
        $q = $db->prepare("INSERT INTO auth_tokens(token, user_id, expires, selector)
                         VALUES(:token, :user_id, DATE_ADD(NOW(), INTERVAL 14 DAY), :selector)");
        $q->execute([
            'user_id'  => $user_id,
            'token'    => hash('sha256', $token),
            'selector' => $selector
        ]);

        // Créer un cookie 'auth' (14 jours expires) httpOnly => true
        // Contenu: base64_encode(selector).':'.base64_encode(token)
        setcookie(
            'auth',
            base64_encode($selector).':'.base64_encode($token),
            time()+1209600,
            null,
            null,
            false,
            true
        );
    }
}

if (!function_exists('auto_login')) {
    function auto_login()
    {
        global $db;
        // Verifier si le cookie 'auth' existe
        if (!empty($_COOKIE['auth'])) {
            $split = explode(':', $_COOKIE['auth']);
            if (count($split) != 2) {
                return false;
            }

            // Récuperer via ce cookie $selector $token
            list($selector, $token) = $split;
           
            $q = $db->prepare("SELECT auth_tokens.id, token, user_id, users.pseudo, users.avatar, users.id, users.email 
            FROM auth_tokens
            LEFT JOIN users
            ON auth_tokens.user_id = users.id
            WHERE selector = ? AND expires >= CURDATE()");
            
            // Décoder notre $selector
            $q->execute([base64_decode($selector)

            ]);

            $data = $q->fetch(PDO::FETCH_OBJ);

            if ($data) {
                if (hash_equals($data->token, hash('sha256', base64_decode($token)))) {
                        $_SESSION['pseudo']  = $data->pseudo;
                        $_SESSION['user_id'] = $data->id;
                        $_SESSION['avatar']  = $data->avatar;
                        $_SESSION['email']   = $data->email;
        
                    return true;
                }
            }
        }
        return false;
    }
}

//Redirect friendly
if (!function_exists('redirect_intent_or')) {
    function redirect_intent_or($default_url)
    {
        if ($_SESSION['forwarding_url']) {
            $url = $_SESSION['forwarding_url'];
        } else {
            $url = $default_url;
        }
        $_SESSION['forwarding_url'] = null;
        redirect($url);
    }
}

//Get a session value by key
if (!function_exists('get_session')) {
    function get_session($key)
    {
        if ($key) {
            return !empty($_SESSION[$key])
                ? e($_SESSION[$key])
                : null;
        }
    }
}

//Get the current locale
if (!function_exists('get_current_locale')) {
    function get_current_locale()
    {
        return $_SESSION['locale'];
    }
}

//Display Gravatar's picture
if (!function_exists('get_avatar_url')) {
    function get_avatar_url($email, $size = 25)
    {
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim(e($email)))) . "?s=" . $size;
    }
}

//Check if an user is connected
if (!function_exists('is_logged_in')) {
    function is_logged_in()
    {
        return isset($_SESSION['user_id']) || isset($_SESSION['pseudo']);
    }
}


//Find an user by id
if (!function_exists('find_user_by_id')) {
    function find_user_by_id($id)
    {
        global $db;
        $q = $db->prepare('SELECT name, pseudo, email, city, country, twitter, github, sex, available_for_hire, bio, avatar FROM users WHERE id = ?');
        $q->execute([$id]);
        $data = $q->fetch(PDO::FETCH_OBJ);
        $q->closeCursor();
        return $data;
    }
}

if (!function_exists('not_empty')) {
    function not_empty($fields = [])
    {
        if (count($fields) != 0) {
            foreach ($fields as $field) {
                if (empty($_POST[$field]) || trim($_POST[$field]) == "") {
                    return false;
                }
            }
            return true;
        }
    }
}

if (!function_exists('is_already_in_use')) {
    function is_already_in_use($field, $value, $table)
    {
        global $db;

        $q = $db->prepare("SELECT id FROM $table WHERE $field = ?");
        $q->execute([$value]);
        $count = $q->rowCount();
        $q->closeCursor();
        return $count;
    }
}

if (!function_exists('set_flash')) {
    function set_flash($message, $type = 'info')
    {
        $_SESSION['notification']['message'] = $message;
        $_SESSION['notification']['type'] = $type;
    }
}

if (!function_exists('redirect')) {
    function redirect($page)
    {
        header('Location:' . $page);
        exit();
    }
}

if (!function_exists('save_input_data')) {
    function save_input_data()
    {
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'password') === false) {
                $_SESSION['input'][$key] = $value;
            }
        }
    }
}

if (!function_exists('get_input')) {
    function get_input($key)
    {
        return !empty($_SESSION['input'][$key])
            ? e($_SESSION['input'][$key])
            : null;
    }
}

if (!function_exists('clear_input_data')) {
    function clear_input_data()
    {
        if (isset($_SESSION['input'])) {
            $_SESSION['input'] = [];
        }
    }
}

//Gère l'état actif de nos différents liens
if (!function_exists('set_active')) {
    function set_active($file)
    {
        $path = explode('/', $_SERVER['SCRIPT_NAME']);
        $page = array_pop($path);

        if ($page == $file . '.php') {
            return "active";
        } else {
            return '';
        }
    }
}
