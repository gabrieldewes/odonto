<?php

use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Tools\Setup,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Mapping\Driver\DatabaseDriver,
    Doctrine\ORM\Tools\DisconnectedClassMetadataFactory,
    Doctrine\ORM\Tools\EntityGenerator;

class Doctrine {
  public $em;

  public function __construct() {
    require APPPATH . 'config/database.php';
    $env = ENVIRONMENT;
    $connection_options = array(
      'driver'        => 'pdo_mysql',
      'user'          => $db[$env]['username'],
      'password'      => $db[$env]['password'],
      'host'          => $db[$env]['hostname'],
      'dbname'        => $db[$env]['database'],
      'charset'       => $db[$env]['char_set'],
      'driverOptions' => array(
        'charset'   => $db[$env]['char_set'],
      ),
    );
    $models_namespace = 'Domain';
    $models_path = APPPATH . 'models';
    $proxies_dir = APPPATH . 'models/Proxies';
    $metadata_paths = array(APPPATH . 'models');
    $config = Setup::createAnnotationMetadataConfiguration($metadata_paths, $dev_mode = true, $proxies_dir);
    $this->em = EntityManager::create($connection_options, $config);
    $loader = new ClassLoader($models_namespace, $models_path);
    $loader->register();
  }

  function generate_classes(){
    $this->em->getConfiguration()
             ->setMetadataDriverImpl(
                        new DatabaseDriver(
                              $this->em->getConnection()->getSchemaManager()));
    $cmf = new DisconnectedClassMetadataFactory();
    $cmf->setEntityManager($this->em);
    $metadata = $cmf->getAllMetadata();
    $generator = new EntityGenerator();

    $generator->setUpdateEntityIfExists(true);
    $generator->setGenerateStubMethods(true);
    $generator->setGenerateAnnotations(true);
    $generator->generate($metadata, APPPATH."models/Domain");
  }
}
