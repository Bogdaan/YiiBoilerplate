# YiiBoilerplate bundle
Структура проекта для быстрой разработки, основана на YiiBoilerplate.


### Структура
Структура файлов проекта:

	/
    backend/
        components/
	config/
            environments/
            	main-private.php *
            	main-prod.php
      			params-private.php *
      			params-prod.php
    	main-env.php *
    	main-local.php *
    	main.php
    	params-env.php *
    	params-local.php *
    	params.php
    	test.php
	controllers/
		SiteController.php
		...
	extensions/
            behaviors/
            validators/
        lib/
        models/
        	FormModel.php
        	...
        modules/
        runtime/ *
        views/
        	layouts/
        	site/
        widgets/
        www/
            assets/ *
            css/
            images/
            js/
            themes/
            index.php
            .htaccess
    common/
        components/
        config/
            environments/
            	params-private.php *
            	params-prod.php
            params-env.php *
            params-local.php *
            params.php
        data/
        extensions/
        	behaviors/
        	validators/
        lib/
            Behat/
            Pear/
            Yii/
            Zend/
        messages/
        models/
        widgets/
    console/
		commands/
		components/
		config/
	    	environments/
		lib/
		migrations/
        models/
        runtime/ *
        yiic.php
    frontend/
		components/
		config/
	    	environments/
	    		main-private.php *
	    		main-prod.php
	    		params-private.php *
	    		params-prod.php
	    	main-env.php *
	    	main-local.php
	    	main.php
	    	params-env.php *
	    	params-local.php *
	    	params.php
	    	test.php
		controllers/
		extensions/
			behaviors/
			validators/
		lib/
		models/	
		modules/	
		runtime/ *
		views/
    		layouts/
    		site/
		www/
	    	assets/ *
	    	css/
	    	files/
	    	images/
            	js/
            	less/
            index.php
            robots.txt
            .htaccess
    tests/
        bootstrap/
            FeatureContext.php
            YiiContext.php
        features/
            Startup.feature
        behat.yml
    
    INSTALL.md
    README.md
    runbehat
    runpostdeploy
    yiic
    yiic.bat

###Корневой каталог
В корневой директории находяться:  
  
* ***backend***: бэкенд, предназначеный для управления приложением.  
* ***console***: консольные команды приложения.   
* ***frontend***: фронтенд приложения, главный интефейс для пользователей.  
* ***common***: общие файлы для фронтенда, бэкенда и консольного приложения.
* ***test***: BDD тесты.

Проект разделен на три приложения: бэкенд, фронтенд, консоль.
Структура приложения аналогична [стуктуре директорий проекта yiiframework.com](http://www.yiiframework.com/wiki/155/the-directory-structure-of-the-yii-project-site)

###Каталоги приложений
Структура директорий каждого приложения почти одинакова.

Общее назначение каталогов:  

* ***components***: содержит компоненты (i.e. helpers, application components) которые могут быть использованы в приложении  
* ***config***: файлы конфигурации.
* ***controllers***: контроллеры
* ***extensions***: Yii расширения
* ***lib***: third-party библиотеки
* ***models***: модели
* ***modules***: модули
* ***views***: представления
* ***widgets***: виджеты 
* ***www***: корневая директория приложения

We have created **extensions** and **widgets** folders, that could had been obviously included in the **components** folder,
in order to clearly differentiate the types of components that could exist into a Yii application and easy the task to find them. 
So, for example, developers won't search for a widget that renders a jQuery UI plugin within a folder that has application wide 
components, or helpers, or extensions, or… 

The directory structure for **console** application differs from the others as it doesn't require **controllers**, **views**,
 **widgets**, and **www**. It has a **commands** directory to store all console command class files.

When developing a large project with a long development cycle, we constantly need to adjust the database structure.
For this reason, we also use the DB migration feature to keep track of database changes. 
We store all DB migrations under the **migrations** directory in **console**.


###Application Configurations
Applications of the same system usually share some common configurations, such as DB connection configuration, application parameters, etc.
In order to eliminate duplication of code, we should extract these common configurations and store them in a central place. 
In our setting, we put them under the config directory in **common**.

####How to configure the application
The configuration for this boilerplate is not that complicated as it seems at first sight.
 As mentioned before, if our system has both **backend** and **frontend** applications and they both share 
 the same DB configuration. We just need to configure one of the files on the **config** sub-directory under the **common** folder.

The files within the config folder of each application and common folder requires a bit of explanation. When working in a team environment, different developers may have different development environments. These environments are also often different from the production environment. This is why the configuration folders on each application contains a list of files that try to avoid interference among the different environments. 

As you can see, the config folders include a set of files:

* environments/***params-private.php***: This is to have the application parameters required for the developer on its development environment.
* environments/**params-prod.php**: This is to have the application parameters required for the application on **production**
* environments/**main-private.php**: The application configuration settings required for the developer on its development environment.
* environments/**main-prod.php**: The application configuration settings required for the application on **production**
* **main-env.php**: This file will be override with the  environment specific application configuration selected by the **runpostDeploy** script (as we are going to explain after)
* **main-local.php**: This is the application configuration options for the developer*
* **params-env.php**: This will be override with the environment specific parameters selected by the **runpostdeploy** script 
* **params-local.php**: The application parameters for the developer*
* **params.php**: The application parameters
* **test.php**: Test application configuration options


The configuration tree override in the following way:

***local settings > environment specific > main configuration file*** 

That means that local settings override environment specific and its result override main configuration file. And this is true for all configurations folders being the common configuration folder settings predominant over the application specific one:

**common shared params > application params**
**common shared config > application config**

There is a slight difference between the ****-private.php*** and the ****-local.php** files. The first ones are automatically read with the ***runpostdeploy*** script and it could be settings that developers sitting on same machines in internal networks, and the latest is the programmer's configurations. 

The base configuration should be put under version control, like regular source code, so that it can be shared by every developer. The local configuration should **not** be put under version control and should only exist in each developer's working directory.


#### Cкрипт _runpostdeploy_ 
The project has a very useful script that automatically creates the required and **not** shared folders for a Yii application: the **runtime** and **assets** folders, extracts the configuration settings specified for a specific environment and copies them to the ****-env.php*** files and runs migrations when not on private environments -we believe that migrations should be always run manually by developers on their machines.

From the application's root folder, to run the script simply do:

```
./runpostdeploy environmentType migrations
```

* **environmentType** (required): can be "any" of the ones you configure on the **environments** folders (i.e. `./runpostdeploy private` to use ****-private.php*** configurations)
* **migrations** (optional): could be "**migrate**"" or "**no-migrate**". 
	* migrate: will run migrations
	* no-migrate: will not run migrations (on private wont run them anyway)


### Расширения YII
В прокект включены следующие расширения:
* tinimce - WYSIWYG редактор [tinymce](http://www.yiiframework.com/extension/tinymce/).
* yii-mail - надстройка SwiftMailer, для отправки email [mail](http://www.yiiframework.com/extension/mail)
* yii-debug-toolbar - удобная панель отладки [debug-toolbar](http://www.yiiframework.com/extension/yii-debug-toolbar/)
* YiiBooster - надстройка Yii-Bootstrap  [YiiBooster](http://yii-booster.clevertech.biz)
* MaintanceMode - расширение позволяет гибко перейти в "режим поддержки". [MaintanceMode](https://github.com/karagodin/MaintenanceMode)

### Отличия от YiiBoilerplate
* добавлен праметр "tablePrefix" (префикс таблиц) 
* добавлены параметры уровня приложения (params-app.php)
* добавлены sql файлы схемы БД, фикстур, удаления таблиц ( common/data/schema.sql, common/data/fixtures.sql, common/data/drop.schema.sql )

### Ветка extended
В эту ветку включены наиболее часто используемые контроллеры, модели, темы.
* добавлены контроллеры: ConfigController, ArticleController, QuestionController, FeedbackController
* добавлены модели: Feedback, Quesion, Article, Config
 

====

