<?php
namespace Mekit\Bundle\CallBundle\Migrations\Schema\v1_0;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class MekitCallBundle implements Migration {
	public static $tableNameCall = "mekit_call";

	/**
	 * @param Schema   $schema
	 * @param QueryBag $queries
	 */
	public function up(Schema $schema, QueryBag $queries) {
		/** Tables and foreign keys generation **/
		$this->createMekitCallTable($schema);
	}

	/**
	 * Create mekit_call table
	 *
	 * @param Schema $schema
	 */
	protected function createMekitCallTable(Schema $schema) {
		$table = $schema->createTable(self::$tableNameCall);
		$table->addColumn('id', 'integer', ['autoincrement' => true]);
		$table->addColumn('description', 'text', ['notnull' => false]);
		$table->addColumn('outcome', 'string', ['length' => 32]);
		$table->addColumn('direction', 'string', ['length' => 4]);

		//INDEXES
		$table->setPrimaryKey(['id']);
		$table->addIndex(['outcome'], 'idx_call_outcome', []);
		$table->addIndex(['direction'], 'idx_call_direction', []);

		//FOREIGN KEYS
		$table->addForeignKeyConstraint(
			$schema->getTable('mekit_list_item'),
			['outcome'],
			['id'],
			['onDelete' => null, 'onUpdate' => null],
			'fk_call_outcome'
		);
	}
}