<?php

namespace Claroline\CoreBundle\Migrations\drizzle_pdo_mysql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2013/08/21 11:59:28
 */
class Version20130821115925 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE claro_home_tab (
                id INT AUTO_INCREMENT NOT NULL, 
                user_id INT DEFAULT NULL, 
                workspace_id INT DEFAULT NULL, 
                name VARCHAR(255) NOT NULL, 
                type VARCHAR(255) NOT NULL, 
                tab_order VARCHAR(255) NOT NULL, 
                PRIMARY KEY(id), 
                INDEX IDX_A9744CCEA76ED395 (user_id), 
                INDEX IDX_A9744CCE82D40A1F (workspace_id), 
                UNIQUE INDEX home_tab_unique_name_user_workspace (name, user_id, workspace_id)
            )
        ");
        $this->addSql("
            CREATE TABLE claro_widget_home_tab_config (
                id INT AUTO_INCREMENT NOT NULL, 
                widget_id INT NOT NULL, 
                home_tab_id INT NOT NULL, 
                widget_order VARCHAR(255) NOT NULL, 
                PRIMARY KEY(id), 
                INDEX IDX_D48CC23EFBE885E2 (widget_id), 
                INDEX IDX_D48CC23E7D08FA9E (home_tab_id), 
                UNIQUE INDEX widget_home_tab_unique_order (
                    widget_id, home_tab_id, widget_order
                )
            )
        ");
        $this->addSql("
            ALTER TABLE claro_home_tab 
            ADD CONSTRAINT FK_A9744CCEA76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_home_tab 
            ADD CONSTRAINT FK_A9744CCE82D40A1F FOREIGN KEY (workspace_id) 
            REFERENCES claro_workspace (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_widget_home_tab_config 
            ADD CONSTRAINT FK_D48CC23EFBE885E2 FOREIGN KEY (widget_id) 
            REFERENCES claro_widget (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_widget_home_tab_config 
            ADD CONSTRAINT FK_D48CC23E7D08FA9E FOREIGN KEY (home_tab_id) 
            REFERENCES claro_home_tab (id) 
            ON DELETE CASCADE
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE claro_widget_home_tab_config 
            DROP FOREIGN KEY FK_D48CC23E7D08FA9E
        ");
        $this->addSql("
            DROP TABLE claro_home_tab
        ");
        $this->addSql("
            DROP TABLE claro_widget_home_tab_config
        ");
    }
}