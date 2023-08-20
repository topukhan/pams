function data() {
  function getThemeFromLocalStorage() {
    // if user already changed the theme, use it
    if (window.localStorage.getItem('dark')) {
      return JSON.parse(window.localStorage.getItem('dark'))
    }

    // else return their preferences
    return (
      !!window.matchMedia &&
      window.matchMedia('(prefers-color-scheme: dark)').matches
    )
  }

  function setThemeToLocalStorage(value) {
    window.localStorage.setItem('dark', value)
  }

  return {
    dark: getThemeFromLocalStorage(),
    toggleTheme() {
      this.dark = !this.dark
      setThemeToLocalStorage(this.dark)
    },
    isSideMenuOpen: false,
    toggleSideMenu() {
      this.isSideMenuOpen = !this.isSideMenuOpen
    },
    closeSideMenu() {
      this.isSideMenuOpen = false
    },
    isNotificationsMenuOpen: false,
    toggleNotificationsMenu() {
      this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
    },
    closeNotificationsMenu() {
      this.isNotificationsMenuOpen = false
    },
    isProfileMenuOpen: false,
    toggleProfileMenu() {
      this.isProfileMenuOpen = !this.isProfileMenuOpen
    },
    closeProfileMenu() {
      this.isProfileMenuOpen = false
    },
    isPagesMenuOpen: false,
    togglePagesMenu() {
      this.isPagesMenuOpen = !this.isPagesMenuOpen
    },
    isGroupsMenuOpen: false,
    toggleGroupsMenu() {
      this.isGroupsMenuOpen = !this.isGroupsMenuOpen
    },
    isRequestsOpen: false,
    toggleRequestsMenu() {
      this.isRequestsOpen = !this.isRequestsOpen
    },
    isGroupsCOORMenuOpen: false,
    toggleGroupsCOORMenu() {
      this.isGroupsCOORMenuOpen = !this.isGroupsCOORMenuOpen
    },
    isFollowUpsOpen: false,
    toggleFollowUpsMenu() {
      this.isFollowUpsOpen = !this.isFollowUpsOpen
    },
    isProposalOpen: false,
    toggleProposalMenu() {
      this.isProposalOpen = !this.isProposalOpen
    },
    isUserManagementMenuOpen: false,
    toggleUserManagementMenu() {
      this.isUserManagementMenuOpen = !this.isUserManagementMenuOpen
    },
    isSupervisorsMenuOpen: false,
    toggleSupervisorsMenu() {
      this.isSupervisorsMenuOpen = !this.isSupervisorsMenuOpen
    },
    isStudentsMenuOpen: false,
    toggleStudentsMenu() {
      this.isStudentsMenuOpen = !this.isStudentsMenuOpen
    },

    // Modal
    isModalOpen: false,
    trapCleanup: null,
    openModal() {
      this.isModalOpen = true
      this.trapCleanup = focusTrap(document.querySelector('#modal'))
    },
    closeModal() {
      this.isModalOpen = false
      this.trapCleanup()
    },
  }
}
