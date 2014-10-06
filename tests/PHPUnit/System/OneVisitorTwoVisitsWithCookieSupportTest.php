<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link    http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Tests\System;

use Piwik\Tests\Impl\SystemTestCase;
use Piwik\Tests\Impl\Fixtures\OneVisitorTwoVisits;

/**
 * Same as OneVisitorTwoVisits.test.php, but with cookie support, which incurs some slight changes
 * in the reporting data (more accurate unique visitor count, better referrer tracking for goals, etc.)
 *
 * @group OneVisitorTwoVisitsWithCookieSupportTest
 * @group Core
 */
class OneVisitorTwoVisitsWithCookieSupportTest extends SystemTestCase
{
    public static $fixture = null; // initialized below class

    /**
     * @dataProvider getApiForTesting
     */
    public function testApi($api, $params)
    {
        $this->runApiTests($api, $params);

    }

    public function getApiForTesting()
    {
        $apiToCall = array(
            'VisitTime', 'VisitsSummary', 'VisitorInterest', 'VisitFrequency', 'UserSettings',
            'UserCountry', 'Referrers', 'Provider', 'Goals', 'CustomVariables', 'CoreAdminHome',
            'Actions', 'Live.getLastVisitsDetails');

        return array(
            array($apiToCall, array('idSite' => self::$fixture->idSite, 'date' => self::$fixture->dateTime))
        );
    }

    public static function getOutputPrefix()
    {
        return 'OneVisitorTwoVisits_withCookieSupport';
    }
}

OneVisitorTwoVisitsWithCookieSupportTest::$fixture = new OneVisitorTwoVisits();
OneVisitorTwoVisitsWithCookieSupportTest::$fixture->useThirdPartyCookies = true;
OneVisitorTwoVisitsWithCookieSupportTest::$fixture->useSiteSearch = true;