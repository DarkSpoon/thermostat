#!/bin/bash

# Source function library.
. /etc/init.d/functions


DIR=/var/www
PIDFILE=$DIR/logs/pid
STARTPIDFILE=$DIR/logs/startpid


start() {
        echo -n "Starting Thermostat: "
        if [ -f $STARTPIDFILE ]; then
                PID=`cat $STARTPIDFILE`
                echo Thermostat already running: $PID
                exit 2;
        elif [ -f $PIDFILE ]; then
                PID=`cat $PIDFILE`
                echo Thermostat already running: $PID
                exit 2;
        else
                cd $DIR
                daemon  ./thermo-server
                RETVAL=$?
                echo
                [ $RETVAL -eq 0 ] && touch /var/lock/subsys/thermo-server
                return $RETVAL
        fi

}

stop() {
        echo -n "Shutting down Thermostat: "
        echo
        killproc thermo-server
        echo
        rm -f /var/lock/subsys/thermo-server
        return 0
}

case "$1" in
    start)
        start
        ;;
    stop)
        stop
        ;;
    status)
        status ns-slapd
        ;;
    restart)
        stop
        start
        ;;
    *)
        echo "Usage:  {start|stop|status|restart}"
        exit 1
        ;;
esac
exit $?