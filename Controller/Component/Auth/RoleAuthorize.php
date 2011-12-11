<?php

App::uses('BaseAuthorize', 'Controller/Component/Auth');
App::uses('Umpermission', 'Usermin.Model');

class RoleAuthorize extends BaseAuthorize {

    /**
     * Checks if a Permission matching plugin, controller and
     * action exists and is allowed to access for the user's
     * role
     * 
     * @param type $user
     * @param CakeRequest $request
     * @return type 
     */
    public function authorize($user, CakeRequest $request) {
        if (isset($this->settings['authorizeAll']) && $this->settings['authorizeAll']) {
            return true;
        }

        $actionRequested = Router::parse($request->here(false));

        $this->_log("user: ${user['username']} is trying to access: p(${actionRequested['plugin']}) c(${actionRequested['controller']}) a(${actionRequested['action']}) ");

        // get permissions for the role
        $Umpermission = new Umpermission();
        $conditions = array('conditions' => array('umrole_id' => $user['umrole_id']));
        //TODO: Use cache here
        $permissionsForUserRole = $Umpermission->find('all', $conditions);

        //this should be optimized (tree or cache)
        foreach ($permissionsForUserRole as $perm) {
            $this->_log("checking permission " . $perm['Umpermission']['id'] . ' = p(' . $perm['Umpermission']['plugin'] . ') c(' . $perm['Umpermission']['controller'] . ') a(' . $perm['Umpermission']['action'] . ')');
            // strict validation, not using * yet
            if (strtoupper($actionRequested['plugin']) == strtoupper($perm['Umpermission']['plugin']) && 
                    strtoupper($actionRequested['controller']) == strtoupper($perm['Umpermission']['controller']) && 
                    strtoupper($actionRequested['action']) == strtoupper($perm['Umpermission']['action'])) {
                $this->_log("permission matches, returning true if allowed");
                return ($perm['Umpermission']['allowed'] == 1);
            }
        }
        $this->_log("no rules matched. user is not allowed ");

        return false;
    }

    /**
     * Filter debug
     *
     * @param type $var 
     */
    private function _log($var) {
        if (isset($this->settings['debug']) && $this->settings['debug']) {
            $this->controller()->log($var, LOG_DEBUG);
        }
    }

}