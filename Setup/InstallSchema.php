<?php

namespace ThinkOpen\Blog\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

    public function install(
        \Magento\Framework\Setup\SchemaSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context)
    {

        
        $installer = $setup;
        $installer->startSetup();
        
        if (!$installer->tableExists('thinkopen_blog_post')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('thinkopen_blog_post')
            )
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'Post ID'
                )
                ->addColumn(
                    'title',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Post Name'
                )
                ->addColumn(
                    'descritption',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Post Description'
                )
                ->addColumn(
                    'body',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [],
                    'Post Content'
                )
                ->addColumn(
                    'tags',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Post Tags'
                )
                ->addColumn(
                    'isactive',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    1,
                    [],
                    'Post Status'
                )
                ->addColumn(
                    'image',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Post Featured Image'
                )
                ->addColumn(
                    'creationdate',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Created At'
                )->addColumn(
                    'lasteditdate',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                    'Updated At')
                ->setComment('Post Table');

            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('thinkopen_blog_post'),
                $setup->getIdxName(
                    $installer->getTable('thinkopen_blog_post'),
                    ['name','description','body','tags','image'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['name','description','body','tags','image'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }

        $installer->endSetup();

    
    }
}

