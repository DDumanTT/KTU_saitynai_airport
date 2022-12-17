export default defineNuxtRouteMiddleware(() => {
    const route = useRoute();
    const { user } = useAuth();
    const allowedRoles = route.meta.allowedRoles as string[];

    if (!user.value) return navigateTo("/login");
    if (!allowedRoles?.length) return;
    if (!allowedRoles.includes(user.value.role)) return navigateTo("/");
});
