<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    private $menuId = null;
    private $dropdownId = array();
    private $dropdown = false;
    private $sequence = 1;
    private $joinData = array();
    private $translationData = array();
    private $defaultTranslation = 'en';
    private $adminRole = null;
    private $userRole = null;

    public function join($roles, $menusId){
        $roles = explode(',', $roles);
        foreach($roles as $role){
            array_push($this->joinData, array('role_name' => $role, 'menus_id' => $menusId));
        }
    }

    /*
        Function assigns menu elements to roles
        Must by use on end of this seeder
    */
    public function joinAllByTransaction(){
        DB::beginTransaction();
        foreach($this->joinData as $data){
            DB::table('menu_role')->insert([
                'role_name' => $data['role_name'],
                'menus_id' => $data['menus_id'],
            ]);
        }
        DB::commit();
    }

    public function addTranslation($lang, $name, $menuId){
        array_push($this->translationData, array(
            'name' => $name,
            'lang' => $lang,
            'menus_id' => $menuId
        ));
    }

    /*
        Function insert All translations
        Must by use on end of this seeder
    */
    public function insertAllTranslations(){
        DB::beginTransaction();
        foreach($this->translationData as $data){
            DB::table('menus_lang')->insert([
                'name' => $data['name'],
                'lang' => $data['lang'],
                'menus_id' => $data['menus_id']
            ]);
        }
        DB::commit();
    }

    public function insertLink($roles, $name, $href, $icon = null){
        if($this->dropdown === false){
            DB::table('menus')->insert([
                'slug' => 'link',
                //'name' => $name,
                'icon' => $icon,
                'href' => $href,
                'menu_id' => $this->menuId,
                'sequence' => $this->sequence
            ]);
        }else{
            DB::table('menus')->insert([
                'slug' => 'link',
                //'name' => $name,
                'icon' => $icon,
                'href' => $href,
                'menu_id' => $this->menuId,
                'parent_id' => $this->dropdownId[count($this->dropdownId) - 1],
                'sequence' => $this->sequence
            ]);
        }
        $this->sequence++;
        $lastId = DB::getPdo()->lastInsertId();
        $this->join($roles, $lastId);
        $this->addTranslation($this->defaultTranslation, $name, $lastId);
        $permission = Permission::where('name', '=', $name)->get();
        if(empty($permission)){
            $permission = Permission::create(['name' => 'visit ' . $name]);
        }
        $roles = explode(',', $roles);
        if(in_array('user', $roles)){
            $this->userRole->givePermissionTo($permission);
        }
        if(in_array('admin', $roles)){
            $this->adminRole->givePermissionTo($permission);
        }
        return $lastId;
    }

   /* Вставка новой строки в таблицу меню. */
    public function insertTitle($roles, $name){
        DB::table('menus')->insert([
            'slug' => 'title',
            'name' => $name,
            'menu_id' => $this->menuId,
            'sequence' => $this->sequence
        ]);
/* Создание нового пользователя и добавление к нему перевода. */
        $this->sequence++;
        $lastId = DB::getPdo()->lastInsertId();
        $this->join($roles, $lastId);
        $this->addTranslation($this->defaultTranslation, $name, $lastId);
        return $lastId;
    }

/* Проверяем, есть ли в массиве dropdownId. Если есть, он установит parentId в последний dropdownId в
массиве. Если нет, он установит для parentId значение null. */
    public function beginDropdown($roles, $name, $icon = ''){
        if(count($this->dropdownId)){
            $parentId = $this->dropdownId[count($this->dropdownId) - 1];
        }else{
            $parentId = null;
        }
/* Вставка записи в таблицу меню. */
        DB::table('menus')->insert([
            'slug' => 'dropdown',
            //'name' => $name,
            'icon' => $icon,
            'menu_id' => $this->menuId,
            'sequence' => $this->sequence,
            'parent_id' => $parentId
        ]);
        /* Добавление нового раскрывающегося списка в базу данных. */
        $lastId = DB::getPdo()->lastInsertId();
        array_push($this->dropdownId, $lastId);
        $this->dropdown = true;
        $this->sequence++;
        $this->join($roles, $lastId);
        $this->addTranslation($this->defaultTranslation, $name, $lastId);
        return $lastId;
    }

/**
 * > Эта функция закрывает выпадающее меню
 */
    public function endDropdown(){
        $this->dropdown = false;
        array_pop( $this->dropdownId );
    }

    /* Создание меню и двух языков. */
    public function run()
    {
        /* Get roles */
        $this->adminRole = Role::where('name' , '=' , 'admin' )->first();
        $this->userRole = Role::where('name', '=', 'user' )->first();
        /* Create Sidebar menu */
        DB::table('menulist')->insert([
            'name' => 'sidebar menu'
        ]);
        $this->menuId = DB::getPdo()->lastInsertId();  //set menuId
        /* Create Translation languages */
        DB::table('menu_lang_lists')->insert([
            'name' => 'English',
            'short_name' => 'en',
            'is_default' => true
        ]);
        DB::table('menu_lang_lists')->insert([
            'name' => 'Polish',
            'short_name' => 'pl'
        ]);
        DB::table('menu_lang_lists')->insert([
            'name' => 'Russian',
            'short_name' => 'ru'
        ]);
        /* sidebar menu */
        $id = $this->insertLink('guest,user,admin', 'Dashboard', '/', 'cil-speedometer');
        $this->addTranslation('pl', 'Panel', $id);
        $this->addTranslation('ru', 'Панель', $id);

        $id = $this->beginDropdown('admin', 'Settings', 'cil-calculator');
        $this->addTranslation('pl', 'Ustawienia', $id);
        $this->addTranslation('ru', 'Настройки', $id);
            $id = $this->insertLink('admin', 'Notes',                   '/notes');
            $this->addTranslation('pl', 'Notatki', $id);
            $this->addTranslation('ru', 'Заметки', $id);
            $id = $this->insertLink('admin', 'Users',                   '/users');
            $this->addTranslation('pl', 'Urzytkownicy', $id);
            $this->addTranslation('ru', 'Пользователи', $id);
            $id = $this->insertLink('admin', 'Edit menu',               '/menu/menu');
            $this->addTranslation('pl', 'Edycja Menu', $id);
            $this->addTranslation('ru', 'Редактирование меню', $id);
            $id = $this->insertLink('admin', 'Edit roles',              '/roles');
            $this->addTranslation('pl', 'Edycja Ról', $id);
            $this->addTranslation('ru', 'Редактирование ролей', $id);
            $id = $this->insertLink('admin', 'Media',                   '/media');
            $this->addTranslation('pl', 'Media', $id);
            $this->addTranslation('ru', 'Медиа', $id);
            $id = $this->insertLink('admin', 'BREAD',                   '/bread');
            $this->addTranslation('pl', 'BREAD', $id);
            $this->addTranslation('ru', 'BREAD', $id);
            $id = $this->insertLink('admin', 'Email',                   '/mail');
            $this->addTranslation('pl', 'Email', $id);
            $this->addTranslation('ru', 'Email', $id);
            $id = $this->insertLink('admin', 'Manage Languages',          '/languages');
            $this->addTranslation('pl', 'Edytuj języki', $id);
            $this->addTranslation('ru', 'Редактирование языков', $id);
        $this->endDropdown();



        $id = $this->insertLink('guest', 'Login', '/login', 'cil-account-logout');
        $this->addTranslation('pl', 'Logowanie', $id);
        $this->addTranslation('ru', 'Вход', $id);
        $id = $this->insertLink('guest', 'Register', '/register', 'cil-account-logout');
        $this->addTranslation('pl', 'Rejestracja', $id);
        $this->addTranslation('ru', 'Регистрация', $id);
        $id = $this->insertTitle('user,admin', 'Theme');
        $this->addTranslation('pl', 'Motyw', $id);
        $this->addTranslation('ru', 'Тема', $id);
        $id = $this->insertLink('user,admin', 'Colors', '/colors', 'cil-drop1');
        $this->addTranslation('pl', 'Kolory', $id);
        $this->addTranslation('ru', 'Цвета', $id);
        $id = $this->insertLink('user,admin', 'Typography', '/typography', 'cil-pencil');
        $this->addTranslation('pl', 'Typografia', $id);
        $this->addTranslation('ru', 'Типография', $id);
        $id = $this->insertTitle('user,admin', 'Components');
        $this->addTranslation('pl', 'Komponenty', $id);
        $this->addTranslation('ru', 'Компоненты', $id);
        $id = $this->beginDropdown('user,admin', 'Base', 'cil-puzzle');
        $this->addTranslation('pl', 'Podstawa', $id);
        $this->addTranslation('ru', 'Основа', $id);
        $id = $this->insertLink('user,admin', 'Breadcrumb',    '/base/breadcrumb');
        $this->addTranslation('pl', 'Chlebek', $id);
        $this->addTranslation('ru', 'Хлебные крошки', $id);
        $id = $this->insertLink('user,admin', 'Cards',         '/base/cards');
        $this->addTranslation('pl', 'Karty', $id);
        $this->addTranslation('ru', 'Карты', $id);
        $id = $this->insertLink('user,admin', 'Carousel',      '/base/carousel');
        $this->addTranslation('pl', 'Karuzela', $id);
        $this->addTranslation('ru', 'Карусель', $id);
        $id = $this->insertLink('user,admin', 'Collapse',      '/base/collapse');
        $this->addTranslation('pl', 'Zapadki', $id);
        $this->addTranslation('ru', 'Закрытие', $id);
        $id = $this->insertLink('user,admin', 'Jumbotron',     '/base/jumbotron');
        $this->addTranslation('pl', 'Karta', $id);
        $this->addTranslation('ru', 'Карта', $id);
        $id = $this->insertLink('user,admin', 'List group',    '/base/list-group');
        $this->addTranslation('pl', 'Zgrupowana lista', $id);
        $this->addTranslation('ru', 'Сгруппированный список', $id);
        $id = $this->insertLink('user,admin', 'Navs',          '/base/navs');
        $this->addTranslation('pl', 'Nawigacja', $id);
        $this->addTranslation('ru', 'Навигация', $id);
        $id = $this->insertLink('user,admin', 'Pagination',    '/base/pagination');
        $this->addTranslation('pl', 'Paginacja', $id);
        $this->addTranslation('ru', 'Пагинация', $id);
        $id = $this->insertLink('user,admin', 'Popovers',      '/base/popovers');
        $this->addTranslation('pl', 'Podpowiedź', $id);
        $this->addTranslation('ru', 'Подсказка', $id);
        $id = $this->insertLink('user,admin', 'Progress',      '/base/progress');
        $this->addTranslation('pl', 'Pasek postępu', $id);
        $this->addTranslation('ru', 'Полоса прогресса', $id);
        $id = $this->insertLink('user,admin', 'Scrollspy',     '/base/scrollspy');
        $this->addTranslation('pl', 'Śledzenie przesunięcia', $id);
        $this->addTranslation('ru', 'Отслеживание прокрутки', $id);
        $id = $this->insertLink('user,admin', 'Switches',      '/base/switches');
        $this->addTranslation('pl', 'Przełączniki', $id);
        $this->addTranslation('ru', 'Переключатели', $id);
        $id = $this->insertLink('user,admin', 'Tabs',          '/base/tabs');
        $this->addTranslation('pl', 'Zakładki', $id);
        $this->addTranslation('ru', 'Вкладки', $id);
        $id = $this->insertLink('user,admin', 'Tooltips',      '/base/tooltips');
        $this->addTranslation('pl', 'Wskazówka', $id);
        $this->addTranslation('ru', 'Подсказка', $id);
    $this->endDropdown();
    $id = $this->beginDropdown('user,admin', 'Buttons', 'cil-cursor');
    $this->addTranslation('pl', 'Przyciski', $id);
    $this->addTranslation('ru', 'Кнопки', $id);
        $id = $this->insertLink('user,admin', 'Buttons',           '/buttons/buttons');
        $this->addTranslation('pl', 'Przyciski', $id);
        $this->addTranslation('ru', 'Кнопки', $id);
        $id = $this->insertLink('user,admin', 'Brand Buttons',     '/buttons/brand-buttons');
        $this->addTranslation('pl', 'Przyciski z logotypami', $id);
        $this->addTranslation('ru', 'Кнопки с логотипами', $id);
        $id = $this->insertLink('user,admin', 'Buttons Group',     '/buttons/button-group');
        $this->addTranslation('pl', 'Grupy przycisków', $id);
        $this->addTranslation('ru', 'Группы кнопок', $id);
        $id = $this->insertLink('user,admin', 'Dropdowns',         '/buttons/dropdowns');
        $this->addTranslation('pl', 'Przyciski z rozwijanym menu', $id);
        $this->addTranslation('ru', 'Кнопки с выпадающим меню', $id);
        $id = $this->insertLink('user,admin', 'Loading Buttons',   '/buttons/loading-buttons');
        $this->addTranslation('pl', 'Przyciski z oczekiwaniem', $id);
        $this->addTranslation('ru', 'Кнопки с ожиданием', $id);
    $this->endDropdown();
    $id = $this->insertLink('user,admin', 'Charts', '/charts', 'cil-chart-pie');
    $this->addTranslation('pl', 'Wykresy', $id);
    $this->addTranslation('ru', 'Графики', $id);
    $id = $this->beginDropdown('user,admin', 'Editors', 'cil-code');
    $this->addTranslation('pl', 'Edytor', $id);
    $this->addTranslation('ru', 'Редактор', $id);
        $id = $this->insertLink('user,admin', 'Code Editor',           '/editors/code-editor');
        $this->addTranslation('pl', 'Edytor kodu', $id);
        $this->addTranslation('ru', 'Редактор кода', $id);
        $id = $this->insertLink('user,admin', 'Markdown',              '/editors/markdown-editor');
        $this->addTranslation('pl', 'Edytor markdown', $id);
        $this->addTranslation('ru', 'Редактор markdown', $id);
        $id = $this->insertLink('user,admin', 'Rich Text Editor',      '/editors/text-editor');
        $this->addTranslation('pl', 'Bogaty edytor tekstu', $id);
        $this->addTranslation('ru', 'Расширенный редактор текста', $id);
    $this->endDropdown();
    $id = $this->beginDropdown('user,admin', 'Forms', 'cil-notes');
    $this->addTranslation('pl', 'Formularze', $id);
    $this->addTranslation('ru', 'Формы', $id);
        $id = $this->insertLink('user,admin', 'Basic Forms',           '/forms/basic-forms');
        $this->addTranslation('pl', 'Podstawowe formularze', $id);
        $this->addTranslation('ru', 'Основные формы', $id);
        $id = $this->insertLink('user,admin', 'Advanced',              '/forms/advanced-forms');
        $this->addTranslation('pl', 'Zaawansowane formularze', $id);
        $this->addTranslation('ru', 'Расширенные формы', $id);
        $id = $this->insertLink('user,admin', 'Validation',      '/forms/validation');
        $this->addTranslation('pl', 'Walidacja', $id);
        $this->addTranslation('ru', 'Валидация', $id);
    $this->endDropdown();
    $id = $this->insertLink('user,admin', 'Google Maps', '/google-maps', 'cil-map');
    $this->addTranslation('pl', 'Mapy Google', $id);
    $this->addTranslation('ru', 'Карты Google', $id);
    $id = $this->beginDropdown('user,admin', 'Icons', 'cil-star');
    $this->addTranslation('pl', 'Ikony', $id);
    $this->addTranslation('ru', 'Иконки', $id);
        $id = $this->insertLink('user,admin', 'CoreUI Icons',      '/icon/coreui-icons');
        $this->addTranslation('pl', 'CoreUI ikony', $id);
        $this->addTranslation('ru', 'CoreUI иконки', $id);
        $id = $this->insertLink('user,admin', 'Flags',             '/icon/flags');
        $this->addTranslation('pl', 'Flagi', $id);
        $this->addTranslation('ru', 'Флаги', $id);
        $id = $this->insertLink('user,admin', 'Brands',            '/icon/brands');
        $this->addTranslation('pl', 'Logotypy', $id);
        $this->addTranslation('ru', 'Логотипы', $id);
    $this->endDropdown();
    $id = $this->beginDropdown('user,admin', 'Notifications', 'cil-bell');
        $this->addTranslation('pl', 'Powiadomienia', $id);
        $this->addTranslation('ru', 'Уведомления', $id);
            $id = $this->insertLink('user,admin', 'Alerts',     '/notifications/alerts');
            $this->addTranslation('pl', 'Alerty', $id);
            $this->addTranslation('ru', 'Оповещения', $id);
            $id = $this->insertLink('user,admin', 'Badge',      '/notifications/badge');
            $this->addTranslation('pl', 'Etykieta', $id);
            $this->addTranslation('ru', 'Этикетка', $id);
            $id = $this->insertLink('user,admin', 'Modals',     '/notifications/modals');
            $this->addTranslation('pl', 'Okno powiadomienia', $id);
            $this->addTranslation('ru', 'Окно уведомления', $id);
            $id = $this->insertLink('user,admin', 'Toastr',     '/notifications/toastr');
            $this->addTranslation('pl', 'Tosty', $id);
            $this->addTranslation('ru', 'Тосты', $id);
        $this->endDropdown();
        $id = $this->beginDropdown('user,admin', 'Plugins',     'cil-bolt');
        $this->addTranslation('pl', 'Wtyczki', $id);
        $this->addTranslation('ru', 'Плагины', $id);
            $id = $this->insertLink('user,admin', 'Calendar',      '/plugins/calendar');
            $this->addTranslation('pl', 'Kalendarz', $id);
            $this->addTranslation('ru', 'Календарь', $id);
            $id = $this->insertLink('user,admin', 'Draggable',     '/plugins/draggable-cards');
            $this->addTranslation('pl', 'Elementy przesówne', $id);
            $this->addTranslation('ru', 'Перетаскиваемые элементы', $id);
            $id = $this->insertLink('user,admin', 'Spinners',      '/plugins/spinners');
            $this->addTranslation('pl', 'Kręciołki', $id);
            $this->addTranslation('ru', 'Крутилки', $id);
        $this->endDropdown();
        $id = $this->beginDropdown('user,admin', 'Tables', 'cil-columns');
        $this->addTranslation('pl', 'Tablice', $id);
        $this->addTranslation('ru', 'Таблицы', $id);
            $id = $this->insertLink('user,admin', 'Standard Tables',   '/tables/tables');
            $this->addTranslation('pl', 'Standardowe tablice', $id);
            $this->addTranslation('ru', 'Стандартные таблицы', $id);
            $id = $this->insertLink('user,admin', 'DataTables',        '/tables/datatables');
            $this->addTranslation('pl', 'Arkusze danych', $id);
            $this->addTranslation('ru', 'Таблицы данных', $id);
        $this->endDropdown();
        $id = $this->insertLink('user,admin', 'Widgets', '/widgets', 'cil-calculator');
        $this->addTranslation('pl', 'Widżety', $id);
        $this->addTranslation('ru', 'Виджеты', $id);
        $id = $this->insertTitle('user,admin', 'Extras');
        $this->addTranslation('pl', 'Ekstra', $id);
        $this->addTranslation('ru', 'Экстра', $id);
        $id = $this->beginDropdown('user,admin', 'Pages', 'cil-star');
        $this->addTranslation('pl', 'Strony', $id);
        $this->addTranslation('ru', 'Страницы', $id);
            $id = $this->insertLink('user,admin', 'Login',         '/login');
            $this->addTranslation('pl', 'Logowanie', $id);
            $this->addTranslation('ru', 'Вход', $id);
            $id = $this->insertLink('user,admin', 'Register',      '/register');
            $this->addTranslation('pl', 'Rejestracja', $id);
            $this->addTranslation('ru', 'Регистрация', $id);
            $id = $this->insertLink('user,admin', 'Error 404',     '/404');
            $this->addTranslation('pl', 'Błąd 404', $id);
            $this->addTranslation('ru', 'Ошибка 404', $id);
            $id = $this->insertLink('user,admin', 'Error 500',     '/500');
            $this->addTranslation('pl', 'Błąd 500', $id);
            $this->addTranslation('ru', 'Ошибка 500', $id);
        $this->endDropdown();
        $id = $this->beginDropdown('user,admin', 'Apps', 'cil-layers');
        $this->addTranslation('pl', 'Aplikacje', $id);
        $id = $this->beginDropdown('user,admin', 'Invoicing', 'cil-description');
        $this->addTranslation('pl', 'Faktury', $id);
            $id = $this->insertLink('user,admin', 'Invoice',       '/apps/invoicing/invoice');
            $this->addTranslation('pl', 'Faktura', $id);
        $this->endDropdown();
        $id = $this->beginDropdown('user,admin', 'Email', 'cil-envelope-open');
        $this->addTranslation('pl', 'E-mail', $id);
            $id = $this->insertLink('user,admin', 'Inbox',         '/apps/email/inbox');
            $this->addTranslation('pl', 'Skrzynka odbiorcza', $id);
            $id = $this->insertLink('user,admin', 'Message',       '/apps/email/message');
            $this->addTranslation('pl', 'Wiadomość', $id);
            $id = $this->insertLink('user,admin', 'Compose',       '/apps/email/compose');
            $this->addTranslation('pl', 'Nowa wiadomość', $id);
        $this->endDropdown();
        $this->endDropdown();

        $id = $this->insertLink('guest,user,admin', 'Download CoreUI', 'https://coreui.io', 'cil-cloud-download');
        $this->addTranslation('pl', 'Pobierz CoreUI', $id);
        $id = $this->insertLink('guest,user,admin', 'Try CoreUI PRO', 'https://coreui.io/pro/', 'cil-layers');
        $this->addTranslation('pl', 'Wypróbuj CoreUI PRO', $id);

        /* Create top menu */
        DB::table('menulist')->insert([
            'name' => 'top menu'
        ]);
        $this->menuId = DB::getPdo()->lastInsertId();  //set menuId
        $id = $this->insertLink('guest,user,admin', 'Dashboard',    '/');
        $this->addTranslation('pl', 'Panel', $id);
        $id = $this->insertLink('user,admin', 'Notes',              '/notes');
        $this->addTranslation('pl', 'Notatki', $id);
        $id = $this->insertLink('admin', 'Users',                   '/users');
        $this->addTranslation('pl', 'Urzytkownicy', $id);
        $id = $this->beginDropdown('admin', 'Settings');
        $this->addTranslation('pl', 'Ustawienia', $id);

        $id = $this->insertLink('admin', 'Edit menu',               '/menu/menu');
        $this->addTranslation('pl', 'Edytuj Menu', $id);
        $id = $this->insertLink('admin', 'Edit menu elements',      '/menu/element');
        $this->addTranslation('pl', 'Edytuj elementy menu', $id);
        $id = $this->insertLink('admin', 'Manage Languages',          '/languages');
        $this->addTranslation('pl', 'Edytuj języki', $id);
        $id = $this->insertLink('admin', 'Edit roles',              '/roles');
        $this->addTranslation('pl', 'Edytuj role', $id);
        $id = $this->insertLink('admin', 'Media',                   '/media');
        $this->addTranslation('pl', 'Media', $id);
        $id = $this->insertLink('admin', 'BREAD',                   '/bread');
        $this->addTranslation('pl', 'BREAD', $id);

        $this->endDropdown();

        $this->joinAllByTransaction();   ///   <===== Must by use on end of this seeder
        $this->insertAllTranslations();  ///   <===== Must by use on end of this seeder
    }
}
