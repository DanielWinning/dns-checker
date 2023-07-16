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
        stage('Deploy') {
            steps {
                catchError(buildResult: 'FAILURE', stageResult: 'FAILURE') {
                    sh '''
                    ssh danny@161.35.170.201 'cd /var/www/dns-check.winningsoftware.co.uk/ && git fetch && git pull && composer install && npm install && npm run build'
                    '''
                }
            }
        }
        stage('Cleanup') {
            steps {
                catchError(stageResult: 'FAILURE') {
                    sh '''
                    rm -r dns-tool
                    '''
                }
            }
        }
    }
}