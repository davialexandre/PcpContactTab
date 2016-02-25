<?php

require_once 'CiviTest/CiviUnitTestCase.php';

abstract class PcpcontacttabUnitTestCase extends CiviUnitTestCase {

    protected function loadExtensionFixtures() {
        $fixturesDir = __DIR__ . '/../fixtures';

        $this->getConnection()->getConnection()->query("SET FOREIGN_KEY_CHECKS = 0;");

        $yamlFiles = glob($fixturesDir . '/*.yaml');
        foreach ($yamlFiles as $yamlFixture) {
            $op = new PHPUnit_Extensions_Database_Operation_Insert();
            $dataset = new PHPUnit_Extensions_Database_DataSet_YamlDataSet($yamlFixture);
            $this->_tablesToTruncate = array_merge($this->_tablesToTruncate, $dataset->getTableNames());
            $op->execute($this->_dbconn, $dataset);
        }

        $this->getConnection()->getConnection()->query("SET FOREIGN_KEY_CHECKS = 1;");
    }
}