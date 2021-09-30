<?php

use Phoenix\Database\Element\ColumnSettings;
use Phoenix\Migration\AbstractMigration;

class DailyPicks extends AbstractMigration
{
    protected function up(): void
    {
        $this->table('daily_picks')
            ->addColumn('game_id', 'integer')
            ->addColumn('type', 'string')
            ->addColumn('acc_group', 'string', [ColumnSettings::SETTING_NULL => true])
            ->addColumn('code', 'integer')
            ->addColumn('title', 'string')
            ->addColumn('date', 'string')
            ->addColumn('time', 'string')
            ->addColumn('group', 'string')
            ->addColumn('choice', 'string')
            ->addColumn('odds', 'string')
            ->addColumn('market', 'string')
            ->addColumn('result', 'string', [ColumnSettings::SETTING_NULL => true])
            ->addColumn('status', 'string', [ColumnSettings::SETTING_DEFAULT => 'pending'])
            ->create();
    }

    protected function down(): void
    {
        $this->table('daily_picks')
            ->drop();
    }
}
