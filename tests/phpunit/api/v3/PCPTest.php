<?php
require_once __DIR__.'/../../PcpcontacttabUnitTestCase.php';

class api_v3_PCPTest extends PcpcontacttabUnitTestCase {

    function setUp() {
        parent::setUp();
        $this->loadAllFixtures();
        $this->loadExtensionFixtures();
    }

    function tearDown() {
        parent::tearDown();
    }

    /**
     * @dataProvider getContributionsData
     */
    public function testGetContributionsCount($pcp_id, $expected_count) {
        $params = array('sequential' => 1, 'pcp_id' => $pcp_id);
        $result = $this->callAPISuccess('PCP', 'getcontributionscount', $params);
        $this->assertEquals($expected_count, $result['result']);
    }

    public function testGetContributionsCountForInvalidPCP() {
        $params = array('sequential' => 1, 'pcp_id' => 9999);
        $this->callAPIFailure('PCP', 'getcontributionscount', $params);
    }

    /**
     * @dataProvider getAmountRaisedData
     */
    public function testGetAmountRaised($pcp_id, $expected_amount) {
        $params = array('sequential' => 1, 'pcp_id' => $pcp_id);
        $result = $this->callAPISuccess('PCP', 'getamountraised', $params);
        $this->assertEquals($expected_amount, $result['result']);
    }

    public function testGetAmountRaisedForInvalidPCP() {
        $params = array('sequential' => 1, 'pcp_id' => 9999);
        $this->callAPIFailure('PCP', 'getamountraised', $params);
    }

    public function getContributionsData() {
        return array(
            array(9990, 3),
            array(9991, 1)
        );
    }

    public function getAmountRaisedData() {
        return array(
            array(9990, "149.10"),
            array(9991, "55.00"),
        );
    }
}