<?php

require_once __DIR__.'/../../../PcpcontacttabUnitTestCase.php';
require_once __DIR__.'/../../../../../CRM/Pcpcontacttab/BAO/PCP.php';

class CRM_Pcpcontacttab_BAO_PCPTest extends PcpcontacttabUnitTestCase {

  function setUp() {
    parent::setUp();
    $this->tablesToTruncate = array(
        'civicrm_pcp',
    );

    $this->quickCleanup($this->tablesToTruncate);

    $this->loadAllFixtures();
    $this->loadExtensionFixtures();
  }

  function tearDown() {
    parent::tearDown();
  }

  /**
   * @dataProvider getPcpBlockTargetEntityInfoData
   */
  public function testGetPcpBlockTargetEntityInfo($pcp_id, $component, $expected) {
    $entity_info = CRM_Pcpcontacttab_BAO_PCP::getPcpBlockTargetEntityInfo($pcp_id, $component);
    $this->assertEquals($expected, $entity_info);
  }

  /**
   * @dataProvider getNumberOfContributionsData
   */
  public function testGetNumberOfContributions($pcp_id, $expected_number) {
    $number_of_contributions = CRM_Pcpcontacttab_BAO_PCP::getNumberOfContributions($pcp_id);
    $this->assertEquals($expected_number, $number_of_contributions);
  }

  /**
   * @dataProvider getAmountRaisedData
   */
  public function testGetAmountRaised($pcp_id, $expected_amount) {
    $amount_raised = CRM_Pcpcontacttab_BAO_PCP::getAmountRaised($pcp_id);
    $this->assertEquals($expected_amount, $amount_raised);
  }

  public function getPcpBlockTargetEntityInfoData() {
    return array(
      array(9990, 'contribute', array('id' => 1, 'type' => 'contribute')),
      array(9991, 'event', array('id' => 1, 'type' => 'event')),
      array(9990, 'event', array()),
      array(9991, 'contribute', array()),
      array(9999, 'contribute', array()),
    );
  }

  public function getNumberOfContributionsData() {
    return array(
      array(9990, 3),
      array(9991, 1),
      array(rand(1, 9989), 0),
      array('dsadsa', 0)
    );
  }

  public function getAmountRaisedData() {
    return array(
        array(9990, "149.10"),
        array(9991, "55.00"),
        array(rand(1, 9989), "0.00"),
        array('dsadsa', "0.00")
    );
  }

}
