<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Spatie\Permission\Models\Role;
use App\Models\User;

class _aCoreUITest extends TestCase
{
    //private $testingClass;
    use DatabaseMigrations;

    public function setUp() :void {
        parent::setUp();
    }

    public function testHomepage(){
        $response = $this->get( '/' );
        $response->assertStatus(200);
    }

    public function testColors(){
        $response = $this->get( '/colors' );
        $response->assertStatus(403);
    }

    public function testColorsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/colors' );
        $response->assertStatus(200);
    }

    public function testTypography(){
        $response = $this->get( '/typography' );
        $response->assertStatus(403);
    } 
    
    public function testTypographyActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/typography' );
        $response->assertStatus(200);
    }

    public function testGoogleMaps(){
        $response = $this->get( '/google-maps' );
        $response->assertStatus(403);
    }
    
    public function testGoogleMapsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/google-maps' );
        $response->assertStatus(200);
    }

/* ################   BASE   ############### */
    public function testBaseBreadcrumb(){
        $response = $this->get( '/base/breadcrumb' );
        $response->assertStatus(403);
    }

    public function testBaseBreadcrumbActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/base/breadcrumb' );
        $response->assertStatus(200);
    }

    public function testBaseCards(){
        $response = $this->get( '/base/cards' );
        $response->assertStatus(403);
    }

    public function testBaseCardsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/base/cards' );
        $response->assertStatus(200);
    }

    public function testBaseCarousel(){
        $response = $this->get( '/base/carousel' );
        $response->assertStatus(403);
    }

    public function testBaseCarouselActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/base/carousel' );
        $response->assertStatus(200);
    }

    public function testBaseCollapse(){
        $response = $this->get( '/base/collapse' );
        $response->assertStatus(403);
    }

    public function testBaseCollapseActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/base/collapse' );
        $response->assertStatus(200);
    }

    public function testBaseJumbotron(){
        $response = $this->get( '/base/jumbotron' );
        $response->assertStatus(403);
    }

    public function testBaseJumbotronActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/base/jumbotron' );
        $response->assertStatus(200);
    }

    public function testBaseListgroup(){
        $response = $this->get( '/base/list-group' );
        $response->assertStatus(403);
    }

    public function testBaseListGroupActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/base/list-group' );
        $response->assertStatus(200);
    }

    public function testBaseNavs(){
        $response = $this->get( '/base/navs' );
        $response->assertStatus(403);
    }

    public function testBaseNavsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/base/navs' );
        $response->assertStatus(200);
    }

    public function testBasePagination(){
        $response = $this->get( '/base/pagination' );
        $response->assertStatus(403);
    }

    public function testBasePaginationActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/base/pagination' );
        $response->assertStatus(200);
    }

    public function testBasePopovers(){
        $response = $this->get( '/base/popovers' );
        $response->assertStatus(403);
    }

    public function testBasePopoversActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/base/popovers' );
        $response->assertStatus(200);
    }

    public function testBaseProgress(){
        $response = $this->get( '/base/progress' );
        $response->assertStatus(403);
    }

    public function testBaseProgressActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/base/progress' );
        $response->assertStatus(200);
    }

    public function testBaseScrollSpy(){
        $response = $this->get( '/base/scrollspy' );
        $response->assertStatus(403);
    }

    public function testBaseScrollSpyActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/base/scrollspy' );
        $response->assertStatus(200);
    }

    public function testBaseSwitches(){
        $response = $this->get( '/base/switches' );
        $response->assertStatus(403);
    }

    public function testBaseSwitchesActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/base/switches' );
        $response->assertStatus(200);
    }

    public function testBaseTabs(){
        $response = $this->get( '/base/tabs' );
        $response->assertStatus(403);
    }

    public function testBaseTabsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/base/tabs' );
        $response->assertStatus(200);
    }

    public function testBaseTooltips(){
        $response = $this->get( '/base/tooltips' );
        $response->assertStatus(403);
    }

    public function testBaseTooltipsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/base/tooltips' );
        $response->assertStatus(200);
    }

/* #################   BUTTONS   ###################  */
    public function testButtonsButtons(){
        $response = $this->get( '/buttons/buttons' );
        $response->assertStatus(403);
    }

    public function testButtonsButtonsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/buttons/buttons' );
        $response->assertStatus(200);
    }

    public function testButtonsButtongroup(){
        $response = $this->get( '/buttons/button-group' );
        $response->assertStatus(403);
    }

    public function testButtonsButtongroupActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/buttons/button-group' );
        $response->assertStatus(200);
    }

    public function testButtonsDropdowns(){
        $response = $this->get( '/buttons/dropdowns' );
        $response->assertStatus(403);
    }

    public function testButtonsDropdownsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/buttons/dropdowns' );
        $response->assertStatus(200);
    }

    public function testBrandButtons(){
        $response = $this->get( '/buttons/brand-buttons' );
        $response->assertStatus(403);
    }

    public function testButtonsBrandButtonsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/buttons/brand-buttons' );
        $response->assertStatus(200);
    }

    public function testLoadingButtons(){
        $response = $this->get( '/buttons/loading-buttons' );
        $response->assertStatus(403);
    }

    public function testButtonsLoadingButtonsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/buttons/loading-buttons' );
        $response->assertStatus(200);
    }

/*  ##################    CHARTS    ################ */
    public function testCharts(){
        $response = $this->get( '/charts' );
        $response->assertStatus(403);
    }

    public function testChartsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/charts' );
        $response->assertStatus(200);
    }

/*  ##################    EDITORS    ################ */

    public function testCodeEditor(){
        $response = $this->get( '/editors/code-editor' );
        $response->assertStatus(403);
    }

    public function testCodeEditorActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/editors/code-editor' );
        $response->assertStatus(200);
    }

    public function testMarkdownEditor(){
        $response = $this->get( '/editors/markdown-editor' );
        $response->assertStatus(403);
    }

    public function testMarkdownEditorActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/editors/markdown-editor' );
        $response->assertStatus(200);
    }

    public function testTextEditor(){
        $response = $this->get( '/editors/text-editor' );
        $response->assertStatus(403);
    }

    public function testTextEditorActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/editors/text-editor' );
        $response->assertStatus(200);
    }

/*  ##################    FORMS    ################ */

    public function testBaseForms(){
        $response = $this->get( '/forms/basic-forms' );
        $response->assertStatus(403);
    }

    public function testBaseFormActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/forms/basic-forms' );
        $response->assertStatus(200);
    }

    public function testAdvancedForms(){
        $response = $this->get( '/forms/advanced-forms' );
        $response->assertStatus(403);
    }

    public function testAdvencedFormsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/forms/advanced-forms' );
        $response->assertStatus(200);
    }

    public function testValidationForms(){
        $response = $this->get( '/forms/validation' );
        $response->assertStatus(403);
    }

    public function testValidationFormsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/forms/validation' );
        $response->assertStatus(200);
    }

/*  #################    ICONS    ################# */
    public function testIconsCoreuiIcons(){
        $response = $this->get( '/icon/coreui-icons' );
        $response->assertStatus(403);
    }

    public function testIconsCoreuiIconsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/icon/coreui-icons' );
        $response->assertStatus(200);
    }

    public function testIconsFlags(){
        $response = $this->get( '/icon/flags' );
        $response->assertStatus(403);
    }

    public function testIconsFlagActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/icon/flags' );
        $response->assertStatus(200);
    }

    public function testIconsBrands(){
        $response = $this->get( '/icon/brands' );
        $response->assertStatus(403);
    }

    public function testIconsBrandsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/icon/brands' );
        $response->assertStatus(200);
    }
    
/*  ###############    NOTIFICATIONS    ################# */
    public function testNotificationsAlerts(){
        $response = $this->get( '/notifications/alerts' );
        $response->assertStatus(403);
    }

    public function testNotificationsAlertsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/notifications/alerts' );
        $response->assertStatus(200);
    }

    public function testNotificationsBadge(){
        $response = $this->get( '/notifications/badge' );
        $response->assertStatus(403);
    }

    public function testNotificationsBadgeActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/notifications/badge' );
        $response->assertStatus(200);
    }

    public function testNotificationsModals(){
        $response = $this->get( '/notifications/modals' );
        $response->assertStatus(403);
    }

    public function testNotificationsModalsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/notifications/modals' );
        $response->assertStatus(200);
    }

    public function testToastrModals(){
        $response = $this->get( '/notifications/toastr' );
        $response->assertStatus(403);
    }

    public function testToastrActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/notifications/toastr' );
        $response->assertStatus(200);
    }

/*  ##############   PLUGINS   ###############  */

    public function testPluginsCalendar(){
        $response = $this->get( '/plugins/calendar' );
        $response->assertStatus(403);
    }

    public function testPluginsCalendarActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/plugins/calendar' );
        $response->assertStatus(200);
    }

    public function testPluginsDraggableCards(){
        $response = $this->get( '/plugins/draggable-cards' );
        $response->assertStatus(403);
    }

    public function testPluginsDraggableCardsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/plugins/draggable-cards' );
        $response->assertStatus(200);
    }

    public function testPluginsSpinners(){
        $response = $this->get( '/plugins/spinners' );
        $response->assertStatus(403);
    }

    public function testPluginsSpinnersActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/plugins/spinners' );
        $response->assertStatus(200);
    }

/*  ##############   TABLES   ###############  */

    public function testTablesTables(){
        $response = $this->get( '/tables/tables' );
        $response->assertStatus(403);
    }

    public function testTablesTablesActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/tables/tables' );
        $response->assertStatus(200);
    }

    public function testTablesDataTables(){
        $response = $this->get( '/tables/datatables' );
        $response->assertStatus(403);
    }

    public function testTablesDataTablesActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/tables/datatables' );
        $response->assertStatus(200);
    }

/*  ##############   WIDGETS   ###############  */
    public function testWidgets(){
        $response = $this->get( '/widgets' );
        $response->assertStatus(403);
    }

    public function testWidgetsActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/widgets' );
        $response->assertStatus(200);
    }

/*  ##############   APPS   ###############  */
    public function testAppsInvocingInvoice(){
        $response = $this->get( '/apps/invoicing/invoice' );
        $response->assertStatus(403);
    }

    public function testAppsInvocingInvoiceActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/apps/invoicing/invoice' );
        $response->assertStatus(200);
    }

    public function testAppsEmailInbox(){
        $response = $this->get( '/apps/email/inbox' );
        $response->assertStatus(403);
    }

    public function testAppsEmailInboxActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/apps/email/inbox' );
        $response->assertStatus(200);
    }

    public function testAppsEmailMessage(){
        $response = $this->get( '/apps/email/message' );
        $response->assertStatus(403);
    }

    public function testAppsEmailMessageActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/apps/email/message' );
        $response->assertStatus(200);
    }

    public function testAppsEmailCompose(){
        $response = $this->get( '/apps/email/compose' );
        $response->assertStatus(403);
    }

    public function testAppsEmailComposeActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/apps/email/compose' );
        $response->assertStatus(200);
    }

/*  ##############    PAGES    ############### */
    public function testLogin(){
        $response = $this->get( '/login' );
        $response->assertStatus(200);
    }

    public function testRegister(){
        $response = $this->get( '/register' );
        $response->assertStatus(200);
    }

    public function test404(){
        $response = $this->get( '/404' );
        $response->assertStatus(403);
    }

    public function test404ActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/404' );
        $response->assertStatus(200);
    }

    public function test500(){
        $response = $this->get( '/500' );
        $response->assertStatus(403);
    }

    public function test500ActingAsUser(){
        $user = User::factory()->create();
        $roleUser = Role::create(['name' => 'user']);
        $user->assignRole($roleUser);
        $response = $this->actingAs($user)->get( '/500' );
        $response->assertStatus(200);
    }
}
