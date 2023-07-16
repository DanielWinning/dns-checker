pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                cleanWs()

                catchError(buildResult: 'FAILURE', stageResult: 'FAILURE') {
                    sh '''
                    git clone git@github.com:WinningWebSoftware/dns-tool.git
                    '''
                }
            }
        }
        stage('Composer Install') {
            steps {
                catchError(buildResult: 'FAILURE', stageResult: 'FAILURE') {
                    sh '''
                    cd dns-tool && composer install
                    '''
                }
            }
        }
        stage('PHP Unit Tests') {
            steps {
                catchError(buildResult: 'FAILURE', stageResult: 'FAILURE') {
                    sh '''
                    cd dns-tool && vendor/bin/phpunit --log-junit results/phpunit.xml -c phpunit.xml
                    '''
                }

                junit 'dns-tool/results/phpunit.xml'
            }
        }
        stage('Cleanup') {
            steps {
                catchError(buildResult: 'FAILURE', stageResult: 'FAILURE') {
                    sh '''
                    rm -r dns-tool
                    '''
                }
            }
        }
    }
}